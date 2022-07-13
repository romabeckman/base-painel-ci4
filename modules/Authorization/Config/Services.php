<?php

namespace Authorization\Config;

use \Authorization\Application\Libraries\HmacService;
use \Authorization\Application\Services\ForgotPasswordService;
use \Authorization\Application\Services\LoginService;
use \Authorization\Application\Services\PermissionService;
use \Authorization\Application\Services\UpdatePasswordService;
use \Authorization\Application\Services\UserService;
use \Authorization\Infrastructure\Persistence\Repository\GroupRepository;
use \Authorization\Infrastructure\Persistence\Repository\PermissionRepository;
use \Authorization\Infrastructure\Persistence\Repository\RecoveryRepository;
use \Authorization\Infrastructure\Persistence\Repository\UserRepository;
use \Authorization\Infrastructure\Session\UserSession;
use \CodeIgniter\Config\BaseService;

/**
 * Description of Services
 *
 * @author Romário Beckman
 */
class Services extends BaseService {

    static public function groupRepository(bool $getShared = true): GroupRepository {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new GroupRepository;
    }

    static public function userRepository(bool $getShared = true): UserRepository {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new UserRepository;
    }

    static public function permissionRepository(bool $getShared = true): PermissionRepository {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new PermissionRepository;
    }

    static public function recoveryRepository(bool $getShared = true): RecoveryRepository {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new RecoveryRepository;
    }

    static public function hmacService(bool $getShared = true): HmacService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new HmacService;
    }

    static public function loginService(bool $getShared = true): LoginService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new LoginService;
    }

    static public function forgotPassowrdService(bool $getShared = true): ForgotPasswordService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new ForgotPasswordService;
    }

    static public function userSession(bool $getShared = true): UserSession {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new UserSession;
    }

    static public function updatePasswordService(bool $getShared = true): UpdatePasswordService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new UpdatePasswordService;
    }

    static public function userService(bool $getShared = true): UserService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new UserService;
    }

    static public function permissionService(bool $getShared = true): PermissionService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new PermissionService;
    }

}
