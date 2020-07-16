<?php

namespace Authorization\Config;

use \Authorization\Libraries\AuthSession;
use \Authorization\Repository\AuthRepository;
use \Authorization\Services\GroupService;
use \Authorization\Services\HmacService;
use \Authorization\Services\LoginService;
use \Authorization\Services\PermissionService;
use \Authorization\Services\UpdatePassword;
use \Authorization\Services\UserService;
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

    static function authUserService(): UserService {
        return new UserService();
    }

    static function authGroupService(): GroupService {
        return new GroupService();
    }

    static function authPermissionService(): PermissionService {
        return new PermissionService();
    }
}
