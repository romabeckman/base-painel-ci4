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
     * @var \Authorization\Models\PermissionModel
     */
    public $permissionModel;

    /**
     * @var \Authorization\Models\UserModel
     */
    public $userModel;

    /**
     * @var \Authorization\Models\GroupModel
     */
    public $groupModel;

    public function __construct() {
        $this->permissionModel = new \Authorization\Models\PermissionModel;
        $this->userModel = new \Authorization\Models\UserModel;
        $this->groupModel = new \Authorization\Models\GroupModel;
    }

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

    public function userHasPermission(int $idGroup, int $idRoute): bool {
        return $this->permissionModel
                        ->where(['id_auth_group' => $idGroup, 'id_sys_route' => $idRoute])
                        ->countAllResults() > 0;
    }

    public function getAllGroupPermission(int $idGroup) {
        $idGroup = db_connect()->escape($idGroup);
        $routerModel = \System\Config\Services::sysRepository()->routeModel;
        $permission = $routerModel
                ->select('CONCAT(controller, "::", if(method is null, "", method)) as identifier', false)
                ->select('(SELECT COUNT(*) FROM ' . $this->permissionModel->table .
                        ' WHERE ' . $routerModel->table . '.id = ' . $this->permissionModel->table . '.id_sys_route and ' .
                        $this->permissionModel->table . '.id_auth_group = ' . $idGroup . ') > 0 as exist', false)
                ->where(['sys_route.access' => \System\Entity\Route::ACCESS_PRIVATE])
                ->findAll();
        return array_column($permission, 'exist', 'identifier');
    }

    public function paginateGroup(?string $search = null): array {
        if (!empty($search)) {
            $this->userModel->like('name', $search);
        }

        return [
            'itens' => $this->groupModel
                    ->orderBy('name')
                    ->paginate(PAGE_ITENS),
            'pager' => $this->groupModel->pager,
            'total' => $this->groupModel->countAllResults()
        ];
    }

    public function paginateUser(?string $search = null): array {
        if (!empty($search)) {
            $search = $this->userModel->db->escapeString($search);
            $this->userModel->where('(' . aesDecrypt('name') . ' like "%' . $search . '%" or ' . aesDecrypt('email') . ' like "%' . $search . '%")', null, false);
        }

        return [
            'itens' => $this->userModel
                    ->selectDecrypted()
                    ->subSelect('id_auth_group', $this->groupModel, 'name', 'group')
                    ->orderBy('name')
                    ->paginate(PAGE_ITENS),
            'pager' => $this->userModel->pager,
            'total' => $this->userModel->countAllResults()
        ];
    }

}
