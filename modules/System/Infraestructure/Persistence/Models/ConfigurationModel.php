<?php

namespace System\Infraestructure\Persistence\Models;

use \App\Models\BaseModel;

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
