<?php

namespace System\Config;

use \CodeIgniter\Config\BaseService;

/**
 * Description of Services
 *
 * @author Romário Beckman
 */
class Services extends BaseService {

    static public function repository(): Repository {
        isset(static::$instances[__METHOD__]) || static::$instances[__METHOD__] = new Repository;
        return static::$instances[__METHOD__];
    }

}
