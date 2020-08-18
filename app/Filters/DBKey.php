<?php

namespace App\Filters;

use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use \Config\Database;
use \Config\Services;

class DBKey implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {

    }

    public function before(RequestInterface $request, $arguments = null) {
        $db = Database::connect();
        $key = Services::encrypter()->key;
        $db->query("SET @key = '{$key}'");
    }


}
