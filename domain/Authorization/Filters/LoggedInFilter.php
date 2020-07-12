<?php

namespace Authorization\Filters;

use \Authorization\Config\Auth;
use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use function \service;

/**
 * Description of LoggedIn
 *
 * @author Romário Beckman
 */
class LoggedInFilter implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response) {

    }

    public function before(RequestInterface $request) {
        $session = service('authSession')->getSession();

        if (!$session->has('user')) {
            return;
        }

        $idUser = $session->get('user');
        $userModel = service('authRepository')->userModel;
        Auth::$user = $userModel->selectDecrypted()->find($idUser);
    }

}
