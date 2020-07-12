<?php

namespace Authorization\Repository;

use \Authorization\Entity\User;

/**
 * Description of AuthRepository
 *
 * @author Romário Beckman
 */
class AuthRepository {

    /**
     * @autowired
     * @var \Authorization\Models\PermissionModel
     */
    public $permissionModel;

    /**
     * @autowired
     * @var \Authorization\Models\UserModel
     */
    public $userModel;

    public function getUserFromEmail(string $email): ?User {
        $user = $this->userModel
                ->selectDecrypted()
                ->whereDecrypted('email', $email)
                ->first();

        return $user ?: null;
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
