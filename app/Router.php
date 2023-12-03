<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException ;
use App\Exceptions\UnAuthorizedException ;

class Router 
{
	private array $routes ;
	private array $middlewareStack ;

	public function register(string $routeMethod,string $route, callable | array $action): self
	{
		$this->routes[$routeMethod][$route] = $action ;

		return $this;
	}

	public function get(string $route, callable | array $action): self
	{
	 	return $this->register('get', $route, $action);
	}

	public function post(string $route, callable | array $action): self
	{
		return $this->register('post', $route, $action);
	}

	public function middleware( callable $middleware): self
	{
		$this->middlewareStack[] = $middleware ;
		return $this ;
	}

	private function runMiddlewareStack()
    {
        foreach ($this->middlewareStack as $middleware) {
            call_user_func($middleware);
        }
    }

	public function routes(): self
	{
		return $this->routes ;
	}

	public function resolve(string $requestUri, string $requestMethod)
	{	
		try{
			$route = explode('?', $requestUri)[0];

			$action = $this->routes[$requestMethod][$route] ?? null ;

			if( ! $action){

				throw new RouteNotFoundException();
			}

			$this->runMiddlewareStack();

			$this->authorize($route);

			if( is_callable($action)){
				return call_user_func($action) ;
			}

			if( is_array($action)){

				[$class, $method] = $action;
				
				if(class_exists($class)){
				
					$class = new $class() ;
				
					if(method_exists($class, $method)){
						
						return call_user_func_array([$class, $method],[]);
					}
				}
			}

			throw new RouteNotFoundException();

		}catch(UnAuthorizedException $error){
			return $error->getMessage();
		}
	}


	private function authorize(string $route)
	{

		if ( !isset($_SESSION['user_id'])) {
			if($route !== '/login'){
				header('location: /login');
				exit();
			}
		}

		if(isset($_SESSION['user_role'])){
			$allowedRoutes = $this->getAllowedRoutes($_SESSION['user_role']);
			$routeFound = false;
			foreach ($allowedRoutes as $allowedRoute) {
				if (strtolower($route) === strtolower($allowedRoute)) {
					$routeFound = true;
					break;
				}
			}

			if (!$routeFound) {			
				throw new UnAuthorizedException('Not Authorized to access this path');
			}
		}
	}

	private function getAllowedRoutes(string $userRole): array
	{	
		$commonRoutes = ['/','/logout'];

		switch ($userRole) {
			case 'admin':
				return array_merge($commonRoutes, $this->getAdminRoutes());
			case 'counter_staff':
				return array_merge($commonRoutes, $this->getCounterRoutes());
			case 'kitchen_staff':
				return array_merge($commonRoutes, $this->getKitchenRoutes());
			default:
				return $commonRoutes;
		}
	}


	private function getAdminRoutes(): array
	{
		return ['/admin/dashboard', 
				'/admin/users', 
				'/admin/orders',
				'/admin/menus',
				'/admin/profile',
				'/menu/create',
				'/menu/update/status',
				'/menu/update',
				'/menu/delete'
				];
	}

	private function getCounterRoutes(): array
	{
		return ['/counter/new_order',
				'/counter/home',
				'/counter/all_orders', 
				'/counter/profile',
				'/counter/pending_payments',
				'/payment/update/status',
				'/order/create'
				];
	}

	private function getKitchenRoutes(): array
	{
		return ['/kitchen/pending_orders', 
				'/kitchen/all_orders',
				'/kitchen/profile',
				'/kitchen/menus',
				'/order/update/status',
				'/menu/update/status'
				];
	}

}