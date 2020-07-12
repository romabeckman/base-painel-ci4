<?php

namespace Authorization\Repository;

use \App\Singleton;
use \Config\Services;
use \System\Entity\Log;
use \System\Models\LogModel;

/**
 * Description of AuthRepository
 *
 * @author Romário Beckman
 */
class SysRepository extends Singleton {

    public function saveLog(string $description, int $idUser, array $options = []): void {
        $log = new Log();
        $log->id_auth_user = $idUser;
        $log->description = [
            'description' => $description,
            'options' => $options
        ];
        $log->ip = Services::request()->getIPAddress();

        (new LogModel())->insert($log);
    }

}
