<?php

namespace Authorization\Repository;

use \Authorization\Entity\User;
use \Authorization\Models\UserModel;
use \Config\Services;
use \System\Entity\Log;
use \System\Models\LogModel;

/**
 * Description of AuthRepository
 *
 * @author Romário Beckman
 */
class AuthRepository {

    public function getUserFromEmail(string $email): User {
        $userModel = new UserModel();

        $user = $userModel
                ->selectDecrypted()
                ->whereDecrypted('email', $email)
                ->first();

        return $user;
    }

    public function saveLastLogin(int $idUser): void {
        (new UserModel())->update($idUser, ['last_login_at' => date('Y-m-d H:i:s')]);
    }

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
