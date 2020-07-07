<?php

namespace Authorization\Models;

use \Authorization\Entity\User;
use \CodeIgniter\Model;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class UserModel extends Model {

    protected $table = 'auth_user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_auth_group', 'name', 'email', 'password'
    ];
    protected $returnType = User::class;
    protected $useTimestamps = true;
    protected $validationRules = [
        'id_auth_group' => 'required',
        'name'          => 'required',
        'email'         => 'required|valid_email|is_unique[auth_user.email,id,{id}]',
        'login'         => 'required',
        'password'      => 'required'
    ];

}
