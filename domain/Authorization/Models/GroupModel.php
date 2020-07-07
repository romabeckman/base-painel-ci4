<?php

namespace Authorization\Models;

use \CodeIgniter\Model;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class GroupModel extends Model {

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
