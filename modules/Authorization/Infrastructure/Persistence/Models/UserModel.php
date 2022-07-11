<?php

namespace Authorization\Infrastructure\Persistence\Models;

use \Authorization\Infrastructure\Persistence\Entity\User;
use \Shared\Persistence\Abstracts\BaseModel;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class UserModel extends BaseModel {

    protected $table = 'auth_user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_auth_group', 'name', 'email', 'password', 'last_login_at'
    ];
    protected $returnType = User::class;
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

}
