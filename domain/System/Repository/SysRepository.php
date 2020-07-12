<?php

namespace System\Repository;

use \Config\Services;
use \System\Entity\Log;
use \System\Entity\Route;

/**
 * Description of AuthRepository
 *
 * @author Romário Beckman
 */
class SysRepository {

    /**
     * @autowired
     * @var \System\Models\RouteModel
     */
    public $routeModel;

    /**
     * @autowired
     * @var \System\Models\LogModel
     */
    public $logModel;

    /**
     * @autowired
     * @var \System\Models\ConfigurationModel
     */
    public $configurationModel;

    public function saveLog(string $description, int $idUser, array $options = []): void {
        $log = new Log();
        $log->id_auth_user = $idUser;
        $log->description = [
            'description' => $description,
            'options' => $options
        ];
        $log->ip = Services::request()->getIPAddress();

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
        $config = $this->configurationModel
                ->selectDecrypted()
                ->find($key);

        if (empty($config)) {
            return null;
        }

        return $config['value'];
    }

}
