<?php

namespace Authorization\Filters;

use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use function \uri_string;

/**
 * Description of LoggedIn
 *
 * @author Romário Beckman
 */
class Permission implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response) {

    }

    public function before(RequestInterface $request) {
        if (strpos(uri_string(), 'authentication') === 0) {
            return;
        }


    }

}
