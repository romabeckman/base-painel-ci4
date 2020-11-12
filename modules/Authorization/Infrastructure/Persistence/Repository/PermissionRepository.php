<?php

namespace Authorization\Infrastructure\Persistence\Repository;

use \Authorization\Infrastructure\Persistence\Models\PermissionModel;
use \Shared\Persistence\Abstracts\RepositoryBase;

/**
 * Description of GroupRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
class PermissionRepository extends RepositoryBase {

    protected string $modelClass = PermissionModel::class;

    public function userHasPermission(int $idGroup, int $idRoute): bool {
        return $this->getModel()
                        ->where(['id_auth_group' => $idGroup, 'id_sys_route' => $idRoute])
                        ->countAllResults() > 0;
    }

}
