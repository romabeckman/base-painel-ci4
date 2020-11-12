<?php

namespace System\Config;

use \CodeIgniter\Config\BaseService;
use \System\Infrastructure\Persistence\Repository\ConfigurationRepository;
use \System\Infrastructure\Persistence\Repository\LogRepository;
use \System\Infrastructure\Persistence\Repository\RouteRepository;

/**
 * Description of Services
 *
 * @author Romário Beckman
 */
class Services extends BaseService {

    static public function configurationRepository(bool $getShared = true): ConfigurationRepository {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new ConfigurationRepository;
    }

    static public function logRepository(bool $getShared = true): LogRepository {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new LogRepository;
    }

    static public function routeRepository(bool $getShared = true): RouteRepository {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new RouteRepository;
    }

}
