<?php

namespace Authorization\Application\Services;

use \Authorization\Config\Auth;
use \Authorization\Config\Services as AuthorizationService;

/**
 * Description of UpdatePassword
 *
 * @author Romário Beckman
 */
class UpdatePasswordService {

    public function handler(string $newPassword): void {
        Auth::$user->setPassword($newPassword);
        AuthorizationService::userRepository()->getModel()->update(Auth::$user->id, ['password' => Auth::$user->password]);
    }

}
