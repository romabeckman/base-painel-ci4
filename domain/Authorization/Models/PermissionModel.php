<?php

namespace Authorization\Models;

use \App\Models\BaseModel;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class PermissionModel extends BaseModel {

    protected $table = 'auth_permission';
    protected $primaryKey = null;
    protected $allowedFields = [
        'id_auth_user', 'id_auth_route'
    ];
}
