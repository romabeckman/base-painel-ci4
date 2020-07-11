<?php

namespace Authorization\Service\Login;

use \Authorization\Entity\User;
use \Authorization\Exceptions\Login\InvalidUserEmailException;
use \Authorization\Models\UserModel;
use function \helper;

/**
 * Description of Email
 *
 * @author Romário Beckman
 */
class EmailService {

    public function handler(string $email): User {
        helper('mysql');

        $userModel = new UserModel();

        $user = $userModel
                ->selectDecrypted()
                ->whereDecrypted('email', $email. 'aaaaa')
                ->first();

        if (empty($user)) {
            throw new InvalidUserEmailException(lang('Auth.invalidUserEmail'));
        }
    }

}
