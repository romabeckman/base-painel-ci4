<?php

namespace System\Services;

use \Config\Services;
use \System\Entity\Log;
use \System\Models\LogModel;

/**
 * Description of SaveLog
 *
 * @author Romário Beckman
 */
class SaveLog {

    public function handler(string $description, int $idUser, array $options = []): void {
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
