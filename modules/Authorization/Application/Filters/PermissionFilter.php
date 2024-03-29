<?php

namespace Authorization\Application\Filters;

use \Authorization\Config\Auth;
use \Authorization\Infrastructure\Persistence\Entity\User;
use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use \System\Config\Services;
use \System\Config\Services as SystemService;
use \System\Infrastructure\Persistence\Models\RouteModel;
use function \hasPermission;
use function \helper;
use function \redirect;
use function \service;
use function \view;

/**
 * Description of LoggedIn
 *
 * @author Romário Beckman
 */
class PermissionFilter implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {

    }

    public function before(RequestInterface $request, $arguments = null) {
        $router = service('router');

        $route = SystemService::routeRepository()->getPermission($router->controllerName(), $router->methodName());

        if (empty($route)) {
            return Services::response()->setBody(view('errors/html/error_401'));
        }

        if ($route->access == RouteModel::ACCESS_PUBLIC) {
            return;
        }

        // protected and private route
        if (empty(Auth::$user) || !Auth::$user instanceof User) {
            return redirect()->to('/authentication/logout');
        }
        if ($route->access == RouteModel::ACCESS_PRIVATE) {
            helper('permission');
            if (!hasPermission($router->controllerName(), $router->methodName())) {
                return Services::response()->setBody(view('errors/html/error_401'));
            }
        }
    }

}
