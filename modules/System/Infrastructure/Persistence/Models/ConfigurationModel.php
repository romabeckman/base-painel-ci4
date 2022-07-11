<?php

namespace System\Infrastructure\Persistence\Models;

use \Shared\Persistence\Abstracts\BaseModel;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class ConfigurationModel extends BaseModel {

    protected $table = 'sys_configuration';
    protected $primaryKey = 'key';
    protected $allowedFields = [
        'value', 'key'
    ];

}
