<?php

namespace System\Filters;

use \Authorization\Config\Auth;
use \Authorization\Entity\User;
use \Authorization\Repository\AuthRepository;
use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use \Config\Services;
use \System\Models\RouteModel;
use \System\Repository\SysRepository;
use function \redirect;
use function \view;

/**
 * Description of LoggedIn
 *
 * @author Romário Beckman
 */
class PermissionFilter implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response) {

    }

    public function before(RequestInterface $request) {
        $router = Services::router();
        $sysRepository = SysRepository::getInstance();

        $route = $sysRepository->getPermission($router->controllerName(), $router->methodName());

        if (empty($route) || $route->access == RouteModel::ACCESS_PUBLIC) {
            return;
        }

//        if (empty(Auth::$user) || !Auth::$user instanceof User) {
//            return redirect()->to('/authentication/logout');
//        }

        $authRepository = AuthRepository::getInstance();
        if ($route->access == RouteModel::ACCESS_PRIVATE && $authRepository->userHasPermission(Auth::$user->id, $route) == false) {
            return Services::response()->setBody(view('errors/html/error_401'));
        }
    }

}
