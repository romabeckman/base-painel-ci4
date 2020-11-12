<?php

namespace Authorization\Infrastructure\Session;

use \Authorization\Config\Services as AuthorizationService;
use \Authorization\Infrastructure\Persistence\Entity\User;
use \CodeIgniter\Session\Session;
use \Config\App;
use \Config\Services;
use \System\Config\System;

/**
 * Description of Session
 *
 * @author Romário Beckman
 */
class UserSession {

    /**
     * @var App
     */
    private $app;

    public function __construct() {
        $this->app = new App();
    }

    function create(User $user, bool $rememberMe = false): void {
        $rememberMe && $this->app->sessionExpiration = 86400;
        AuthorizationService::userRepository()->saveLastLogin($user->id);
        System::$log['auth'] = 'Successfully login';

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
