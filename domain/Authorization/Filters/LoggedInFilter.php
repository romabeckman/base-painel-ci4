<?php

namespace Authorization\Filters;

use \Authorization\Config\Auth;
use \Authorization\Config\Services;
use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use \System\Config\Services as Services2;

/**
 * Description of LoggedIn
 *
 * @author Romário Beckman
 */
class LoggedInFilter implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {

    }

    public function before(RequestInterface $request, $arguments = null) {
        $router = Services2::router();
        if (strpos($router->controllerName(), 'App\Controllers\Authentication') !== false) {
            return;
        }

        $session = Services::authSession()->getSession();

        if (!$session->has('user')) {
            return;
        }

        $idUser = $session->get('user');
        $userModel = Services2::authRepository()->userModel;
        Auth::$user = $userModel->selectDecrypted()->find($idUser);
        Auth::$permission = Services2::authRepository()->getAllGroupPermission(Auth::$user->id_auth_group);
    }

}
