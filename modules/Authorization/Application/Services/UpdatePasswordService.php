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
        AuthorizationService::userRepository()
                ->getModel()
                ->update(
                        id: Auth::$user->id,
                        data: [
                            'password' => Auth::$user->password,
                            'force_change_password' => 0
                        ]
        );
    }

}
