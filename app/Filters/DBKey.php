<?php

namespace App\Filters;

use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;
use \Config\Database;
use \Config\Encryption;

class DBKey implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response) {

    }

    public function before(RequestInterface $request) {
        $db = Database::connect();
        $config = new Encryption();

        $db->query("SET @key = '{$config->key}'");
    }

}
