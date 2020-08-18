<?php

namespace Authorization\Libraries;

use \Authorization\Entity\User;
use \CodeIgniter\Session\Session;
use \Config\App;
use \Config\Services;

/**
 * Description of Session
 *
 * @author Romário Beckman
 */
class AuthSession {

    /**
     * @var App
     */
    private $app;

    public function __construct() {
        $this->app = new App();
    }

    function create(User $user, bool $rememberMe = false): void {
        $rememberMe && $this->app->sessionExpiration = 86400;
        \Authorization\Config\Services::repository()->saveLastLogin($user->id);
        \System\Config\Sys::$log['auth'] = 'Successfully login';

        Services::session($this->app)->set([
            'user' => $user->id
        ]);
    }

    function destroy(): void {
        $session = Services::session($this->app);
        $session->stop();
        $session->destroy();
    }

    function getSession(): Session {
        return Services::session($this->app);
    }

}
