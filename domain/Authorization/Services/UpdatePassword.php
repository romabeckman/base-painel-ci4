<?php

namespace Authorization\Services;

use \Authorization\Config\Auth;
use \Authorization\Config\Services;

/**
 * Description of UpdatePassword
 *
 * @author Romário Beckman
 */
class UpdatePassword {

    public function handler(string $newPassword): void {
        Auth::$user->setPassword($newPassword);
        Services::authRepository()->userModel->update(Auth::$user->id, ['password' => Auth::$user->password]);
    }

}
