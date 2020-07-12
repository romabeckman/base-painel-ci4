<?php

namespace Authorization\Filters;

use \Authorization\Config\Auth;
use \Authorization\Libraries\AuthSession;
use \Authorization\Models\UserModel;
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
        $session = new AuthSession();
        $session = $session->getSession();

        if (!$session->has('user')) {
            return;
        }

        $idUser = $session->get('user');
        Auth::$user = (new UserModel)->selectDecrypted()->find($idUser);
    }

}
