<?php

namespace Authorization\Models;

use \Authorization\Entity\Recovery;
use \CodeIgniter\Model;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class RecoveryModel extends Model {

    protected $table = 'auth_recovery';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_auth_user', 'token', 'used_at'
    ];
    protected $returnType = Recovery::class;
    protected $useTimestamps = true;
    protected $validationRules = [
        'id_auth_user' => 'required',
        'token'        => 'required|is_unique[auth_recovery.token]',
    ];

}
