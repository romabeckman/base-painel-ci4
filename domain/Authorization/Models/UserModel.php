<?php

namespace Authorization\Models;

use \App\Models\BaseModel;
use \Authorization\Entity\User;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class UserModel extends BaseModel {

    protected $table = 'auth_user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_auth_group', 'name', 'email', 'login', 'password'
    ];
    protected $encryptFields = [
        'name', 'email', 'login'
    ];
    protected $returnType = User::class;
    protected $useTimestamps = true;

}
