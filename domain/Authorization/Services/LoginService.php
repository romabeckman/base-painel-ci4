<?php

namespace Authorization\Services;

use \Authorization\Entity\User;
use \Authorization\Exceptions\InvalidUserEmailException;
use \Authorization\Exceptions\InvalidUserPasswordException;
use \System\Config\Services;
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

        $user = Services::authRepository()->getUserFromEmail($email);

        if (empty($user)) {
            throw new InvalidUserEmailException(lang('Auth.invalid_user_email'));
        }

        if (Services::authHmac()->validateHash($password, $user->password) == false) {
            throw new InvalidUserPasswordException(lang('Auth.invalid_user_password'));
        }

        return $user;
    }

}
