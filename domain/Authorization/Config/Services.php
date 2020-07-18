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

    static public function authHmac(bool $getShared = true): HmacService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new HmacService;
    }

    static public function authLogin(bool $getShared = true): LoginService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new LoginService;
    }

    static public function authSession(bool $getShared = true): AuthSession {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new AuthSession;
    }

    static public function authRepository(bool $getShared = true): AuthRepository {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new AuthRepository;
    }

    static function authUpdatePassword(bool $getShared = true): UpdatePassword {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new UpdatePassword;
    }

    static function authUserService(bool $getShared = true): UserService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new UserService();
    }

    static function authGroupService(bool $getShared = true): GroupService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new GroupService();
    }

    static function authPermissionService(bool $getShared = true): PermissionService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new PermissionService();
    }

}
