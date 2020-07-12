<?php

namespace App\Services;

use \BadMethodCallException;
use \CodeIgniter\Config\BaseService;
use \Config\Paths;

/**
 * Description of Template
 *
 * @author Romário Beckman
 */
class Template extends BaseService {

    public function templateLogin(array $params = [], ?string $view = null): string {
        !isset($params['title']) && $params['title'] = 'Login';
        $params['captcha_api'] = env('GOOGLE_RECAPTCHA_PUBLIC_KEY');
        return $this->autoloadView($params, $view);
    }

    public function templatePainel(array $params = [], ?string $view = null) {
        !isset($params['title']) && $params['title'] = 'Login';
        return $this->autoloadView($params, $view);
    }

    /**
     * Load view by namespace of controller.
     *
     * @param array $data
     * @param string|null $view Force a name of view
     * @return string
     * @throws BadMethodCallException
     */
    private function autoloadView(array $data = [], ?string $view = null): string {
        $router = service('router');
        $controller = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($router->controllerName()));
        $controller = substr($controller, strpos($controller, 'controllers') + 12);
        $view = is_null($view) ? strtolower($router->methodName()) : $view;
        $view = $controller . DIRECTORY_SEPARATOR . $view . '.php';

        $path = new Paths();

        if (file_exists($path->viewDirectory . DIRECTORY_SEPARATOR . $view)) {
            return view($view, $data);
        }

        throw new BadMethodCallException('View "' . $path->viewDirectory . DIRECTORY_SEPARATOR . $view . '" not exits.');
    }

}
