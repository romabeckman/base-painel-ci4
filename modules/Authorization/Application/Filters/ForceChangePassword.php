<?php

namespace Authorization\Application\Filters;

use \Authorization\Config\Auth;
use \Authorization\Config\Services as AuthorizationServices;
use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use \Config\Services;
use function \redirect;

/**
 * Description of LoggedIn
 *
 * @author Romário Beckman
 */
class ForceChangePassword implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {

    }

    public function before(RequestInterface $request, $arguments = null) {
        if ($this->changePassword() === FALSE) {
            return;
        }

        Services::alertMessages()->setMsgWarning('Por favor forneca uma nova senha');
        return redirect()->to('/profile/password');
    }

    private function changePassword(): bool {
        $session = AuthorizationServices::userSession()->getSession();
        $router = Services::router();

        if (!$session->has('user')) {
            return FALSE;
        }

        if (strpos($router->controllerName(), 'App\Controllers\Profile\Password') !== false) {
            return FALSE;
        }

        if (strpos($router->controllerName(), 'App\Controllers\Authentication') !== false) {
            return FALSE;
        }

        return Auth::$user->force_change_password;
    }

}
