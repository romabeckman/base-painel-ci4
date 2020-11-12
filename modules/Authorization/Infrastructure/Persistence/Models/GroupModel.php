<?php

namespace Authorization\Infrastructure\Persistence\Models;

use \Shared\Persistence\Abstracts\ModelBase;


/**
 * Description of User
 *
 * @author Romário Beckman
 */
class GroupModel extends ModelBase {

    protected $table = 'auth_group';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $validationRules = [
        'name' => 'required'
    ];
    protected $returnType = 'object';

}
