<?php

namespace Authorization\Models;

use \App\Models\BaseModel;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class GroupModel extends BaseModel {

    protected $table = 'auth_group';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name'
    ];
    protected $useTimestamps = true;
    protected $validationRules = [
        'name' => 'required'
    ];

}
