<?php

namespace Authorization\Filters;

use \Authorization\Config\Auth;
use \Authorization\Config\Services as AuthorizationServices;
use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use \Config\Services;

/**
 * Description of LoggedIn
 *
 * @author Romário Beckman
 */
class LoggedInFilter implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {

    }

    public function before(RequestInterface $request, $arguments = null) {
        $router = Services::router();
        if (strpos($router->controllerName(), 'App\Controllers\Authentication') !== false) {
            return;
        }

        $session = AuthorizationServices::authSession()->getSession();

        if (!$session->has('user')) {
            return;
        }

        $idUser = $session->get('user');
        $userModel = AuthorizationServices::repository()->userModel;
        Auth::$user = $userModel->selectDecrypted()->find($idUser);
        Auth::$permission = AuthorizationServices::repository()->getAllGroupPermission(Auth::$user->id_auth_group);
    }

}
