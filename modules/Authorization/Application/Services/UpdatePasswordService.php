<?php

namespace Authorization\Application\Services;

use \Authorization\Config\Auth;
use \Authorization\Config\Services;

/**
 * Description of UpdatePassword
 *
 * @author Romário Beckman
 */
class UpdatePasswordService {

    public function handler(string $newPassword): void {
        Auth::$user->setPassword($newPassword);
        Services::repository()->userModel->update(Auth::$user->id, ['password' => Auth::$user->password]);
    }

}
