<?php

namespace Authorization\Config;

use \Authorization\Libraries\AuthSession;
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

    static public function hmacService(): HmacService {
        return new HmacService;
    }

    static public function loginService(): LoginService {
        return new LoginService;
    }

    static public function authSession(): AuthSession {
        return new AuthSession;
    }

    static public function repository(): Repository {
        isset(static::$instances[__METHOD__]) || static::$instances[__METHOD__] = new Repository;
        return static::$instances[__METHOD__];
    }

    static function updatePassword(): UpdatePassword {
        return new UpdatePassword;
    }

    static function userService(): UserService {
        return new UserService;
    }

    static function groupService(): GroupService {
        return new GroupService;
    }

    static function permissionService(): PermissionService {
        return new PermissionService;
    }

}
