<?php

namespace Authorization\Libraries;

use \Authorization\Entity\User;
use \Authorization\Repository\AuthRepository;
use \System\Repository\SysRepository;
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
        $this->app->sessionCookieName = $this->app->sessionCookieName . '_auth';
    }

    function create(User $user, bool $rememberMe = false) {
        if ($rememberMe) {
            $this->app->sessionExpiration = 86400;
            $this->app->sessionRegenerateDestroy = true;
        }

        AuthRepository::getInstance()->saveLastLogin($user->id);
        SysRepository::getInstance()->saveLog('Login', $user->id);

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
