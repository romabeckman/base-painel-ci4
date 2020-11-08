<?php

namespace Authorization\Infraestructure\Persistence\Repository;

use \Shared\Persistence\Abstracts\RepositoryBase;
use \Authorization\Models\UserModel;
use \Authorization\Config\Services as AuthorizationService;

/**
 * Description of GroupRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
class UserRepository extends RepositoryBase {

    protected string $modelClass = UserModel::class;

    public function getUserFromEmail(string $email): ?User {
        $user = $this->getModel()
                ->selectDecrypted()
                ->whereDecrypted('email', $email)
                ->first();

        return $user ?: null;
    }

    public function saveLastLogin(int $idUser): void {
        $this->getModel()->update($idUser, ['last_login_at' => date('Y-m-d H:i:s')]);
    }

    protected function filter(array $filter = array()): void {
        empty($filter['search']) ||
                $this->getModel()->where(
                        '(' . aesDecrypt('name') . ' like "%' . $filter['search'] . '%" or ' . aesDecrypt('email') . ' like "%' . $filter['search'] . '%")',
                        null,
                        false
        );
    }

    protected function subSelect(): void {
        $this->getModel()->subSelect('id_auth_group', AuthorizationService::groupRepository()->getModel(), 'name', 'group');
    }

}
