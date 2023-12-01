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
	}


	private function authorize(string $route)
	{
		$isAuthenticationRequired = strpos($route, '/admin') === 0 || strpos($route, '/orders') === 0;
		// var_dump($_SESSION);
		if ( $isAuthenticationRequired && !isset($_SESSION['user_role'])) {
			if($route !== '/login'){
				header('location: /login');
				exit();
			}
		}

		// Check user role and route permissions
		if($isAuthenticationRequired && isset($_SESSION['user_role'])){
			$allowedRoutes = $this->getAllowedRoutes($_SESSION['user_role']);
		
			if (!in_array($route, $allowedRoutes)) {
				// header('Location: /401'); // Redirect unauthorized user to the default route
				throw new UnAuthorizedException();
				exit();
			}
		}
	}

	private function getAllowedRoutes(string $userRole): array
	{	
		$commonRoutes = ['/','/logout'];

		switch ($userRole) {
			case 'admin':
				return [$commonRoutes, ...$this->getAdminRoutes()];
			case 'counter_staff':
				return [$commonRoutes, ...$this->getCounterRoutes()];
			case 'kitchen_staff':
				return [$commonRoutes, ...$this->getKitchenRoutes()];
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
				'/admin/profile'
				];
	}

	private function getCounterRoutes(): array
	{
		return ['/counter/new_order',
				'/counter/home',
				'/counter/all_orders', 
				'/counter/profile',
				'/counter/pending_payments'
				];
	}

	private function getKitchenRoutes(): array
	{
		return ['/kitchen/pending_orders', 
				'/kitchen/all_orders',
				'/kitchen/profile',
				'/kitchen/menus'
				];
	}

}