<?php

namespace Authorization\Infrastructure\Persistence\Models;

use \Shared\Persistence\Abstracts\ModelBase;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class PermissionModel extends ModelBase {

    protected $table = 'auth_permission';
    protected $primaryKey = ['id_auth_user', 'id_auth_route'];
    protected $allowedFields = [
        'id_auth_user', 'id_auth_route'
    ];
    protected $returnType = 'object';
}
