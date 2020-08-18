<?php

namespace App\Controllers\Administrator;

use \App\Controllers\BaseController;
use \Config\Services;
use \System\Config\Services as SystemServices;
use function \helper;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class Log extends BaseController {

    public function index() {
        helper('print');
        $paginate = SystemServices::repository()->paginateLog($this->request->getGet('search'));

        $data = [
            'logs' => $paginate['itens'],
            'pager' => $paginate['pager']
        ];

        $data['title'] = 'Log (' . $paginate['total'] . ')';
        return Services::template()->templatePainel($data);
    }

}
