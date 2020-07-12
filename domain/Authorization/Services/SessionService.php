<?php

namespace Authorization\Services;

use \Authorization\Entity\User;
use \Authorization\Repository\AuthRepository;
use \CodeIgniter\Session\Session;
use \Config\App;
use \Config\Services;

/**
 * Description of SessionService
 *
 * @author Romário Beckman
 */
class SessionService {

    private function app(): App {
        $app = new App();
        $app->sessionCookieName = $app->sessionCookieName . '_auth';
        return $app;
    }

    function create(User $user, bool $rememberMe = false) {
        $app = $this->app();

        if ($rememberMe) {
            $app->sessionExpiration = 86400;
            $app->sessionRegenerateDestroy = true;
        }

        $repository = new AuthRepository();
        $repository->saveLastLogin($user->id);
        $repository->saveLog('Login', $user->id);

        Services::session($app)->set([
            'user' => $user->id
        ]);
    }

    function destroy(): void {
        $app = $this->app();
        $session = Services::session($app);
        $session->stop();
        $session->destroy();
    }

    function getSession(): Session {
        $app = $this->app();
        return Services::session($app);
    }

}
