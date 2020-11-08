<?php

namespace Authorization\Config;

use \Authorization\Application\Services\GroupService;
use \Authorization\Application\Services\HmacService;
use \Authorization\Application\Services\LoginService;
use \Authorization\Application\Services\PermissionService;
use \Authorization\Application\Services\UpdatePasswordService;
use \Authorization\Infraestructure\Persistence\Repository\GroupRepository;
use \Authorization\Infraestructure\Persistence\Repository\PermissionRepository;
use \Authorization\Infraestructure\Persistence\Repository\RecoveryRepository;
use \Authorization\Infraestructure\Persistence\Repository\UserRepository;
use \Authorization\Infraestructure\Session\UserSession;
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

    static public function userSession(bool $getShared = true): UserSession {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new UserSession;
    }

    static function updatePasswordService(bool $getShared = true): UpdatePasswordService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new UpdatePasswordService;
    }

    static function userService(bool $getShared = true): UpdatePasswordService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new UpdatePasswordService;
    }

    static function groupService(bool $getShared = true): GroupService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new GroupService;
    }

    static function permissionService(bool $getShared = true): PermissionService {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new PermissionService;
    }

}
