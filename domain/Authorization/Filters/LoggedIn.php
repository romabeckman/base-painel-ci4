<?php

namespace Authorization\Filters;

use \Authorization\Libraries\Auth;
use \Authorization\Models\UserModel;
use \Authorization\Service\Auth\SessionService;
use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use function \redirect;
use function \uri_string;

/**
 * Description of LoggedIn
 *
 * @author Romário Beckman
 */
class LoggedIn implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response) {

    }

    public function before(RequestInterface $request) {
        if (strpos(uri_string(), 'authentication') === 0) {
            return;
        }

        $sessionService = new SessionService();
        $session = $sessionService->getSession();

        if (!$session->has('user')) {
            return redirect()->to('/authentication');
        }

        $idUser = $session->get('user');
        if (!$idUser) {
            return redirect()->to('/authentication');
        }

        Auth::$user = (new UserModel)->selectDecrypted()->find($idUser);
    }

}
