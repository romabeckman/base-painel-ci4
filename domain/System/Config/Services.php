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

    static public function sysRepository(): SysRepository {
        return new SysRepository;
    }

}
