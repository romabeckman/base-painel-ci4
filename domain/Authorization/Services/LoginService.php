<?php

namespace Authorization\Services;

use \Authorization\Config\Services;
use \Authorization\Entity\User;
use \Authorization\Exceptions\InvalidUserEmailException;
use \Authorization\Exceptions\InvalidUserPasswordException;
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

        $user = Services::repository()->getUserFromEmail($email);

        if (empty($user)) {
            \System\Config\Sys::$log['auth'] = 'Invalid login: ' . lang('Auth.invalid_user_email');
            throw new InvalidUserEmailException(lang('Auth.invalid_user_email'));
        }

        if (Services::hmacService()->validateHash($password, $user->password) == false) {
            \System\Config\Sys::$log['auth'] = 'Invalid login: ' . lang('Auth.invalid_user_password');
            throw new InvalidUserPasswordException(lang('Auth.invalid_user_password'));
        }

        return $user;
    }

}
