<?php

namespace Authorization\Repository;

use \App\Singleton;
use \Authorization\Entity\User;
use \Authorization\Models\UserModel;

/**
 * Description of AuthRepository
 *
 * @author Romário Beckman
 */
class AuthRepository extends Singleton {

    public function getUserFromEmail(string $email): User {
        $user = (new UserModel())
                ->selectDecrypted()
                ->whereDecrypted('email', $email)
                ->first();

        return $user;
    }

    public function saveLastLogin(int $idUser): void {
        (new UserModel())->update($idUser, ['last_login_at' => date('Y-m-d H:i:s')]);
    }

}
