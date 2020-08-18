<?php

namespace System\Filters;

use \Authorization\Config\Auth;
use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use \Config\Services;
use \System\Config\Services as SystemService;
use \System\Config\Sys;

/**
 * Description of LoggedIn
 *
 * @author Romário Beckman
 */
class LogRegisterFilter implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        $router = Services::router();
        Sys::$log['request'] = [
            'REQUEST_URI' => $request->getServer()['REQUEST_URI'] ?? '',
            'REQUEST_METHOD' => $request->getServer()['REQUEST_METHOD'] ?? '',
            'CONTENT_TYPE' => $request->getServer()['CONTENT_TYPE'] ?? '',
            'HTTP_REFERER' => $request->getServer()['HTTP_REFERER'] ?? '',
            'SERVER_PROTOCOL' => $request->getServer()['SERVER_PROTOCOL'] ?? ''
        ];

        SystemService::repository()->saveAccessLog(
                $router->controllerName() . '::' . $router->methodName(),
                Auth::$user ? Auth::$user->id : null,
                Sys::$log
        );
    }

    public function before(RequestInterface $request, $arguments = null) {

    }

}
