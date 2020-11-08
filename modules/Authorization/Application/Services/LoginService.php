<?php

namespace Authorization\Application\Services;

use \Authorization\Application\Exceptions\InvalidUserEmailException;
use \Authorization\Application\Exceptions\InvalidUserPasswordException;
use \Authorization\Config\Services as AuthorizationService;
use \Authorization\Infraestructure\Persistence\Entity\User;
use \System\Config\System;
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

        $user = AuthorizationService::userRepository()->getUserFromEmail($email);

        if (empty($user)) {
            System::$log['auth'] = 'Invalid login: ' . lang('Auth.invalid_user_email');
            throw new InvalidUserEmailException(lang('Auth.invalid_user_email'));
        }

        if (AuthorizationService::hmacService()->validateHash($password, $user->password) == false) {
            System::$log['auth'] = 'Invalid login: ' . lang('Auth.invalid_user_password');
            throw new InvalidUserPasswordException(lang('Auth.invalid_user_password'));
        }

        return $user;
    }

}
