<?php

namespace System\Infraestructure\Persistence\Repository;

use \Shared\Persistence\Abstracts\RepositoryBase;
use \System\Entity\Route;
use \System\Models\RouteModel;
use \Authorization\Config\Services as AuthorizationService;

/**
 * Description of GroupRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
class RouteRepository extends RepositoryBase {

    protected string $modelClass = RouteModel::class;

    public function getAllGroupPermission(int $idGroup) {
        $idGroup = db_connect()->escape($idGroup);

        $idGroup == 1 || $this->getModel()->join(
                        AuthorizationService::permissionRepository()->getModel()->table,
                        'id = id_sys_route AND id_auth_group = ' . $idGroup
        );

        $permission = $this->getModel()
                ->select('1 as exist')
                ->select('if(method is null, controller, CONCAT(controller, "::", method)) as identifier', false)
                ->where(['sys_route.access' => Route::ACCESS_PRIVATE])
                ->findAll();
        return array_column($permission, 'exist', 'identifier');
    }

    public function getPermission(string $controller, string $method): ?Route {
        $controller = strpos($controller, '\\') === 0 ? substr($controller, 1) : $controller;

        $route = $this->getModel()
                ->like('controller', $controller, 'after')
                ->where(['method' => $method])
                ->first();

        if (empty($route)) {
            $route = $this->getModel()
                    ->like('controller', $controller, 'after')
                    ->first();
        }

        return $route ?: null;
    }

    public function getAllRouterPermission(?int $idGroup = null) {
        is_null($idGroup) ?
                        $this->getModel()->select('0 as hasPermission', false) :
                        $this->getModel()->select('(SELECT COUNT(*) FROM auth_permission WHERE id = id_sys_route AND id_auth_group = ' . $idGroup . ') as hasPermission');

        return $this->getModel()
                        ->select($this->getModel()->table . '.*')
                        ->where('access', Route::ACCESS_PRIVATE)
                        ->orderBy('group, name')
                        ->findAll();
    }

}
