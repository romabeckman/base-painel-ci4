<?php

namespace Authorization\Models;

use \App\Models\BaseModel;
use \Authorization\Entity\Log;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class UserModel extends BaseModel {

    protected $table = 'auth_log';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_auth_user', 'description'
    ];
    protected $encryptFields = [
        'ip'
    ];
    protected $returnType = Log::class;
    protected $useTimestamps = true;

}
