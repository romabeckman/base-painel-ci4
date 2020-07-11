<?php

namespace Authorization\Service\Auth;

use \Authorization\Entity\User;
use \Authorization\Exceptions\Login\InvalidUserEmailException;
use \Authorization\Exceptions\Login\InvalidUserPasswordException;
use \Authorization\Models\UserModel;
use \Authorization\Service\HmacService;
use function \helper;
use function \lang;

/**
 * Description of Email
 *
 * @author Romário Beckman
 */
class LoginService {

    public function handler(string $email, string $password): User {
        helper('mysql');

        $userModel = new UserModel();

        $user = $userModel
                ->selectDecrypted()
                ->whereDecrypted('email', $email)
                ->first();

        if (empty($user)) {
            throw new InvalidUserEmailException(lang('Auth.invalid_user_email'));
        }

        if ((new HmacService())->validateHash($password, $user->password) == false) {
            throw new InvalidUserPasswordException(lang('Auth.invalid_user_password'));
        }

        return $user;
    }

}
