<?php

namespace Authorization\Repository;

use \App\Singleton;
use \Authorization\Entity\User;

/**
 * Description of AuthRepository
 *
 * @author Romário Beckman
 */
class AuthRepository extends Singleton {

    /**
     * @autowired
     * @var \Authorization\Models\PermissionModel
     */
    private $permissionModel;

    /**
     * @autowired
     * @var \Authorization\Models\UserModel
     */
    private $userModel;

    public function getUserFromEmail(string $email): User {
        $user = $this->userModel
                ->selectDecrypted()
                ->whereDecrypted('email', $email)
                ->first();

        return $user;
    }

    public function saveLastLogin(int $idUser): void {
        $this->userModel->update($idUser, ['last_login_at' => date('Y-m-d H:i:s')]);
    }

    public function userHasPermission(int $idUser, int $idRoute): bool {
        return $this->permissionModel
                ->where(['id_auth_user' => $idUser, 'id_sys_route' => $idRoute])
                ->countAll() > 0;
    }

}
