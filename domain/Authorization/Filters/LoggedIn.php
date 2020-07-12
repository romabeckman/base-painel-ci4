<?php

namespace Authorization\Filters;

use \Authorization\Config\Auth;
use \Authorization\Models\UserModel;
use \Authorization\Services\SessionService;
use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;

/**
 * Description of LoggedIn
 *
 * @author Romário Beckman
 */
class LoggedIn implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response) {

    }

    public function before(RequestInterface $request) {
        $sessionService = new SessionService();
        $session = $sessionService->getSession();

        if (!$session->has('user')) {
            return;
        }

        $idUser = $session->get('user');
        Auth::$user = (new UserModel)->selectDecrypted()->find($idUser);
    }

}
