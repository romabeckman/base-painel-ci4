<?php

namespace System\Infrastructure\Persistence\Models;

use \App\Models\BaseModel;
use \System\Infrastructure\Persistence\Entity\Log;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class LogModel extends BaseModel {

    protected $table = 'sys_log';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_auth_user', 'description', 'ip', 'data'
    ];
    protected $encryptFields = [
        'ip', 'data'
    ];
    protected $returnType = Log::class;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';
    protected $deletedField = '';

}
