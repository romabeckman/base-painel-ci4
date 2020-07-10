<?php

namespace Authorization\Filters;

use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use \Config\Services;

/**
 * Description of LoggedIn
 *
 * @author Romário Beckman
 */
class LoggedIn implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response) {

    }

    public function before(RequestInterface $request) {
        if (strpos(uri_string(), 'authentication') === 0) {
            return;
        }

        $session = Services::session();

        if ($session->has('auth') == false) {
            return redirect()->to('/authentication');
        }
    }

}
