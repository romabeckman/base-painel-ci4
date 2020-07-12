<?php

namespace Authorization\Filters;

use \Authorization\Validation\Auth;
use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use \Config\Services;
use function \redirect;

/**
 * Description of LoggedIn
 *
 * @author Romário Beckman
 */
class Permission implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response) {

    }

    public function before(RequestInterface $request) {
        $router = Services::router();
        return ;

        $controller = $router->controllerName();
        $method = $router->methodName();
        dd($controller);

//        if (empty(Auth::$user)) {
//            return redirect()->to('/authentication/logout');
//        }
    }

}
