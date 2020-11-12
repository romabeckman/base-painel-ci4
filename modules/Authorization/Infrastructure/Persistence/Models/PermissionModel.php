<?php

namespace Authorization\Infrastructure\Persistence\Models;

use \App\Models\BaseModel;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class PermissionModel extends BaseModel {

    protected $table = 'auth_permission';
    protected $primaryKey = ['id_auth_user', 'id_auth_route'];
    protected $allowedFields = [
        'id_auth_user', 'id_auth_route'
    ];
    protected $returnType = 'object';
}
