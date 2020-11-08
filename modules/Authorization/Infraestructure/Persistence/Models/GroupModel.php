<?php

namespace Authorization\Infraestructure\Persistence\Models;

use \App\Models\BaseModel;
use \Authorization\Entity\Group;

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
    protected $useSoftDeletes  = true;
    protected $validationRules = [
        'name' => 'required'
    ];

    protected $returnType = 'object';

}
