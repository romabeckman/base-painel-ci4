<?php

namespace Config;

use \App\Services\AlertMessages;
use \App\Services\Templates\LoginTemplate;
use \App\Services\Templates\PainelTemplate;
use \App\Services\Templates\TemplateInterface;
use \CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService {

    static public function loginTemplate(bool $getShared = true): TemplateInterface {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new LoginTemplate();
    }

    static public function painelTemplate(bool $getShared = true): TemplateInterface {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new PainelTemplate();
    }

    static public function alertMessages(bool $getShared = true): AlertMessages {
        return $getShared ? static::getSharedInstance(__FUNCTION__) : new AlertMessages;
    }

}
