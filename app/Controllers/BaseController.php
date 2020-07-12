<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */
use \App\Libraries\Autowired;
use \BadMethodCallException;
use \CodeIgniter\Config\Services;
use \CodeIgniter\Controller;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use \Config\Paths;
use \Psr\Log\LoggerInterface;
use function \view;

class BaseController extends Controller {

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    public function __construct() {
        $this->helpers[] = 'url';
        $this->helpers[] = 'form';
    }

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        // $this->session = \Config\Services::session();
    }

    /**
     *
     * @param type $method
     * @param type $params
     * @return type
     */
    public function _remap($method, ...$params) {
        $autowired = new Autowired($this);
        $returned = $autowired->invokeMethod($method, $params);

        if (is_array($returned)) {
            return $this->response->setJSON($returned);
        } else {
            return $returned;
        }
    }

    protected function templateLogin(array $params = [], ?string $view = null) {
        !isset($params['title']) && $params['title'] = 'Login';
        $params['captcha_api'] = env('GOOGLE_RECAPTCHA_PUBLIC_KEY');
        return $this->autoloadView($params, $view);
    }

    protected function templatePainel(array $params = [], ?string $view = null) {
        !isset($params['title']) && $params['title'] = 'Login';
        return $this->autoloadView($params, $view);
    }

    /**
     * Load view by namespace of controller.
     *
     * @param array $data
     * @param string|null $viewName Force a name of view
     * @return string
     * @throws BadMethodCallException
     */
    private function autoloadView(array $data = [], ?string $viewName = null): string {
        $router = Services::router();
        $controller = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($router->controllerName()));
        $controller = substr($controller, strpos($controller, 'controllers') + 12);
        $viewName = is_null($viewName) ? strtolower($router->methodName()) : $viewName;
        $view = $controller . DIRECTORY_SEPARATOR . $viewName . '.php';

        $path = new Paths();

        if (file_exists($path->viewDirectory . DIRECTORY_SEPARATOR . $view)) {
            return view($view, $data);
        }

        throw new BadMethodCallException('View "' . $path->viewDirectory . DIRECTORY_SEPARATOR . $view . '" not exits.');
    }
}
