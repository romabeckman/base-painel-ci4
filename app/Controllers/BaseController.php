<?php

namespace App\Controllers;

use \CodeIgniter\Controller;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use \PHPAutowired\Autowired;
use \Psr\Log\LoggerInterface;

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
        $this->helpers[] = 'html';
        $this->helpers[] = 'painel';
        $this->helpers[] = 'bootstrap';
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

}
