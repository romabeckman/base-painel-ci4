<?php

namespace System\Config;

use \Authorization\Config\Services as AuthorizationService;
use \Config\Services;
use \System\Entity\Log;
use \System\Entity\Route;
use \System\Models\ConfigurationModel;
use \System\Models\LogModel;
use \System\Models\RouteModel;

/**
 * Description of AuthRepository
 *
 * @author Romário Beckman
 */
class Repository {

    /**
     * @var RouteModel
     */
    public $routeModel;

    /**
     * @var LogModel
     */
    public $logModel;

    /**
     * @var ConfigurationModel
     */
    public $configurationModel;

    public function __construct() {
        $this->routeModel = new RouteModel;
        $this->logModel = new LogModel;
        $this->configurationModel = new ConfigurationModel;
    }

    public function saveLog(string $description, ?int $idUser = null, array $options = []): void {
        $log = new Log();
        $log->id_auth_user = $idUser;
        $log->description = [
            'description' => $description,
            'options' => $options
        ];
        $log->ip = Services::request()->getIPAddress();
        $this->logModel->insert($log);
    }

    public function saveAccessLog(string $description, ?int $idUser = null, array $options = []): void {
        $post = Services::request()->getPost();
        if (empty($post)) {
            return;
        }

        foreach ($post as $key => $value) {
            $post[$key] = strpos($key, 'password') === false ? $value : '***';
        }

        $log = new Log();
        $log->id_auth_user = $idUser;
        $log->description = [
            'description' => $description,
            'options' => $options
        ];
        $log->ip = Services::request()->getIPAddress();
        $log->data = json_encode($post);
        $this->logModel->insert($log);
    }

    public function getPermission(string $controller, string $method): ?Route {
        $controller = strpos($controller, '\\') === 0 ? substr($controller, 1) : $controller;

        $route = $this->routeModel
                ->like('controller', $controller, 'after')
                ->where(['method' => $method])
                ->first();

        if (empty($route)) {
            $route = $this->routeModel
                    ->like('controller', $controller, 'after')
                    ->first();
        }

        return $route ?: null;
    }

    public function getAllConfiguration(): array {
        $configurations = $this->configurationModel->findAll();
        return empty($configurations) ? [] : array_column($configurations, 'value', 'key');
    }

    public function getConfiguration(string $key): ?string {
        $config = $this->configurationModel->find($key);

        if (empty($config)) {
            return null;
        }

        return $config['value'];
    }

    public function getAllRouterPermission(?int $idGroup = null) {
        is_null($idGroup) ?
                        $this->routeModel->select('0 as hasPermission', false) :
                        $this->routeModel->select('(SELECT COUNT(*) FROM auth_permission WHERE id = id_sys_route AND id_auth_group = ' . $idGroup . ') as hasPermission');

        return $this->routeModel
                        ->select($this->routeModel->table . '.*')
                        ->where('access', Route::ACCESS_PRIVATE)
                        ->orderBy('group, name')
                        ->findAll();
    }

    public function saveConfiguration(array $post): void {
        if (!isset($post['config'])) {
            return;
        }

        $save = [];

        foreach ($post['config'] as $key => $value) {
            $save[] = ['key' => $key, 'value' => $value];
        }

        $this->configurationModel->updateBatch($save, 'key');
    }

    public function paginateLog(?string $search = null) {
        if (!empty($search)) {
            $this->logModel->like('description', $search);
        }

        return [
            'itens' => $this->logModel
                    ->selectDecrypted()
                    ->subSelect('id_auth_user', AuthorizationService::repository()->userModel, 'name', 'user')
                    ->orderBy('id', 'desc')
                    ->paginate(15),
            'pager' => $this->logModel->pager,
            'total' => $this->logModel->countAllResults()
        ];
    }

}
