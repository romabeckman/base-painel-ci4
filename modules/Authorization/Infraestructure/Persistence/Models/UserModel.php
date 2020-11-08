<?php

namespace Authorization\Infraestructure\Persistence\Models;

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
        'id_auth_group', 'name', 'email', 'password', 'last_login_at'
    ];
    protected $encryptFields = [
        'name', 'email'
    ];
    protected $returnType = User::class;
    protected $useTimestamps = true;
    protected $useSoftDeletes  = true;

}
