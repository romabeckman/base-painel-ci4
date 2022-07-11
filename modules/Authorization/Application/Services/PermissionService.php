<?php

namespace Authorization\Application\Services;

use \Authorization\Config\Services as AuthorizationService;

/**
 * Description of UserService
 *
 * @author Romário Beckman
 */
class PermissionService {

    function saveByGroup(int $idGroup, array $permissions): void {
        $permissionModel = AuthorizationService::permissionRepository()->getModel();
        $permissionModel
                ->where(['id_auth_group' => $idGroup])
                ->delete();

        if (empty($permissions)) {
            return;
        }

        $set = array_reduce($permissions, function ($carry, $idRoute) use ($idGroup) {
            $carry[] = ['id_auth_group' => $idGroup, 'id_sys_route' => (int) $idRoute];
            return $carry;
        }, []);
        $permissionModel->insertBatch(set: $set);
    }

}
