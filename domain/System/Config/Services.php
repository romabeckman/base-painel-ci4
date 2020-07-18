<?php

namespace System\Config;

use \CodeIgniter\Config\BaseService;
use \System\Repository\SysRepository;

/**
 * Description of Services
 *
 * @author Romário Beckman
 */
class Services extends BaseService {

    static public function sysRepository(bool $getShared = true): SysRepository {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new SysRepository;
    }

}
