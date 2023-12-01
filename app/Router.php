<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException ;

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
    // Example: Check if the route requires authentication
    $isAuthenticationRequired = strpos($route, '/admin') === 0 || strpos($route, '/manager') === 0;

    if ($isAuthenticationRequired && !isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit();
    }

    // Check user role and route permissions
    $allowedRoutes = $this->getAllowedRoutes($_SESSION['user_role']);

    if (!in_array($route, $allowedRoutes)) {
        header('Location: /'); // Redirect unauthorized user to the default route
        exit();
    }
}

private function getAllowedRoutes(string $userRole): array
{
    switch ($userRole) {
        case 'super_admin':
            return $this->getAllRoutes();
        case 'admin':
            return $this->getAdminRoutes();
        case 'manager':
            return $this->getManagerRoutes();
        case 'staff':
            return $this->getStaffRoutes();
        case 'customer':
            return $this->getCustomerRoutes();
        default:
            return [];
    }
}

private function getAllRoutes(): array
{
    // Return all routes for super admin
    return $this->getAllRoutesFromRegisteredRoutes();
}

private function getAdminRoutes(): array
{
    // Return routes allowed for admin
    return ['/admin/dashboard', '/admin/users', '/admin/orders'];
}

private function getManagerRoutes(): array
{
    // Return routes allowed for manager
    return ['/admin/dashboard', '/admin/users', '/admin/orders', '/manager/reports'];
}

private function getStaffRoutes(): array
{
    // Return routes allowed for staff
    return ['/dashboard', '/orders'];
}

private function getCustomerRoutes(): array
{
    // Return routes allowed for customer
    return ['/dashboard', '/orders', '/profile'];
}

private function getAllRoutesFromRegisteredRoutes(): array
{
    $allRoutes = [];

    foreach ($this->routes as $methodRoutes) {
        $allRoutes = array_merge($allRoutes, array_keys($methodRoutes));
    }

    return $allRoutes;
}


}