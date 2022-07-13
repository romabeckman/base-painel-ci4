<?php

namespace App\Services\Templates;

use \BadMethodCallException;
use \CodeIgniter\Config\BaseService;
use \Config\Paths;
use \Config\Resource;
use \System\Config\System;
use function \service;
use function \view;

/**
 * Description of Template
 *
 * @author Romário Beckman
 */
abstract class BaseTemplate extends BaseService implements TemplateInterface {

    protected Resource $resouces;

    public function __construct() {
        $this->resouces = config('Resource');
        $this->customResources();
    }

    /**
     *
     * @param array $params
     * @param string|null $view
     * @return string
     */
    abstract protected function customParams(array $params): array;

    abstract protected function customResources(): void;

    public function getResouces(): Resource {
        return $this->resouces;
    }

    /**
     * Load view by namespace of controller.
     *
     * @param array $data
     * @param string|null $view Force a name of view
     * @return string
     * @throws BadMethodCallException
     */
    public function view(array $data = [], string $view = ''): string {
        $data = $this->customParams($data);

        $router = service('router');
        $controller = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($router->controllerName()));
        $controller = substr($controller, strpos($controller, 'controllers') + 12);
        $view = empty($view) ? strtolower($router->methodName()) : $view;
        $view = $controller . DIRECTORY_SEPARATOR . $view . '.php';

        $path = new Paths();

        if (file_exists($path->viewDirectory . DIRECTORY_SEPARATOR . $view)) {
            System::$log['template'] = $view;
            return view($view, $data);
        }

        throw new BadMethodCallException('View "' . $view . '" not exits.');
    }

}
