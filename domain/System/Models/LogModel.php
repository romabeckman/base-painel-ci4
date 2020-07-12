<?php

namespace System\Models;

use \App\Models\BaseModel;
use \System\Entity\Log;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class LogModel extends BaseModel {

    protected $table = 'sys_log';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_auth_user', 'description', 'ip'
    ];
    protected $encryptFields = [
        'ip'
    ];
    protected $returnType = Log::class;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

}
