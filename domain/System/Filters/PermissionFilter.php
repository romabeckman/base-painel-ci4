<?php

namespace System\Filters;

use \Authorization\Config\Auth;
use \Authorization\Entity\User;
use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use \Config\Services;
use \System\Models\RouteModel;
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
        $sysRepository = Services::sysRepository();

        $route = $sysRepository->getPermission($router->controllerName(), $router->methodName());

        if (empty($route)) {
            return Services::response()->setBody(view('errors/html/error_401'));
        }

        if ($route->access == RouteModel::ACCESS_PUBLIC) {
            return;
        }

        // protected and provate route
        if (empty(Auth::$user) || !Auth::$user instanceof User) {
            return redirect()->to('/authentication/logout');
        }

        if ($route->access == RouteModel::ACCESS_PRIVATE) {
            helper('painel');
            if (!hasPermission($router->controllerName(), $router->methodName()) && !hasPermission($router->controllerName())) {
                return Services::response()->setBody(view('errors/html/error_401'));
            }
        }
    }


}
