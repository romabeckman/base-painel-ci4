<?php

namespace Authorization\Models;

use \CodeIgniter\Model;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class PermissionModel extends Model {

    protected $table = 'auth_permission';
    protected $primaryKey = null;
    protected $allowedFields = [
        'id_auth_user', 'id_auth_route'
    ];
    protected $useTimestamps = false;
}
