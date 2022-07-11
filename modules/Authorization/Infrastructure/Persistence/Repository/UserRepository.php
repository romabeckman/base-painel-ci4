<?php

namespace Authorization\Infrastructure\Persistence\Repository;

use \Authorization\Config\Services as AuthorizationService;
use \Authorization\Infrastructure\Persistence\Entity\User;
use \Authorization\Infrastructure\Persistence\Models\UserModel;
use \Shared\Persistence\Abstracts\BaseRepository;

/**
 * Description of GroupRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
class UserRepository extends BaseRepository {

    protected string $modelClass = UserModel::class;

    public function getUserFromEmail(string $email): ?User {
        $user = $this->getModel()
                ->where('email', $email)
                ->first();

        return $user ?: null;
    }

    public function saveLastLogin(int $idUser): void {
        $this->getModel()->update($idUser, ['last_login_at' => date('Y-m-d H:i:s')]);
    }

    protected function filter(array $filter = array()): void {
        if (isset($filter['search'])) {
            $this->getModel(renew: FALSE)->where(
                    key: '(name like "%' . $filter['search'] . '%" or email like "%' . $filter['search'] . '%")',
                    value: null,
                    escape: false
            );
        }
    }

    protected function subQueries(): void {
        $this->subSelect(
                fkFieldId: 'id_auth_group',
                model: AuthorizationService::groupRepository()->getModel(renew: FALSE),
                seletcField: 'name',
                showAs: 'group'
        );
    }

}
