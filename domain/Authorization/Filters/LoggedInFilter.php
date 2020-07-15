<?php

namespace Authorization\Filters;

use \Authorization\Config\Auth;
use \Authorization\Config\Services;
use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;

/**
 * Description of LoggedIn
 *
 * @author Romário Beckman
 */
class LoggedInFilter implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response) {

    }

    public function before(RequestInterface $request) {
        $router = Services::router();
        if (strpos($router->controllerName(), 'App\Controllers\Authentication') !== false) {
            return;
        }

        $session = \Authorization\Config\Services::authSession()->getSession();

        if (!$session->has('user')) {
            return;
        }

        $idUser = $session->get('user');
        $userModel = Services::authRepository()->userModel;
        Auth::$user = $userModel->selectDecrypted()->find($idUser);

        Auth::$permission = Services::authRepository()->getAllGroupPermission(Auth::$user->id_auth_group);
    }

}
