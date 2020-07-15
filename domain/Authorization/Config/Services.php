<?php

namespace Authorization\Config;

use \Authorization\Libraries\AuthSession;
use \Authorization\Repository\AuthRepository;
use \Authorization\Services\HmacService;
use \Authorization\Services\LoginService;
use \Authorization\Services\UpdatePassword;
use \CodeIgniter\Config\BaseService;

/**
 * Description of Services
 *
 * @author Romário Beckman
 */
class Services extends BaseService {

    static public function authHmac(): HmacService {
        return new HmacService;
    }

    static public function authLogin(): LoginService {
        return new LoginService;
    }

    static public function authSession(): AuthSession {
        return new AuthSession;
    }

    static public function authRepository(): AuthRepository {
        return new AuthRepository;
    }

    static function authUpdatePassword(): UpdatePassword {
        return new UpdatePassword;
    }
}
