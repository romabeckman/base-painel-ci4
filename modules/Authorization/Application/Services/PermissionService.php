<?php

namespace Authorization\Application\Services;

use \Authorization\Config\Services;

/**
 * Description of UserService
 *
 * @author Romário Beckman
 */
class PermissionService {

    function saveByGroup(int $idGroup, array $permissions): void {
        $permissionModel = Services::repository()->permissionModel;
        $permissionModel
                ->where(['id_auth_group' => $idGroup])
                ->delete();

        if(empty($permissions)) {
            return;
        }

        $set = array_reduce($permissions, function ($carry, $idRoute) use ($idGroup) {
            $carry[] = ['id_auth_group' => $idGroup, 'id_sys_route' => $idRoute];
            return $carry;
        }, []);
        $permissionModel->insertBatch($set);
    }

}
