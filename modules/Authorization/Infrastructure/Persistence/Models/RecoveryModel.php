<?php

namespace Authorization\Infrastructure\Persistence\Models;

use \App\Models\BaseModel;


/**
 * Description of User
 *
 * @author Romário Beckman
 */
class RecoveryModel extends BaseModel {

    protected $table = 'auth_recovery';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_auth_user', 'token', 'used_at'
    ];
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $useSoftDeletes  = true;
    protected $validationRules = [
        'id_auth_user' => 'required',
        'token' => 'required|is_unique[auth_recovery.token]',
    ];

}
