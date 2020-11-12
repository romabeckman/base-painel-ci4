<?php

namespace System\Infrastructure\Persistence\Models;

use \Shared\Persistence\Abstracts\ModelBase;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class ConfigurationModel extends ModelBase {

    protected $table = 'sys_configuration';
    protected $primaryKey = 'key';
    protected $allowedFields = [
        'value', 'key'
    ];

}
