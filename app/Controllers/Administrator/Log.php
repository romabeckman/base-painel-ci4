<?php

namespace App\Controllers\Administrator;

use \App\Controllers\BaseController;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class Log extends BaseController {

    public function index() {
        helper('print');
        $paginate = \System\Config\Services::sysRepository()->paginateLog($this->request->getGet('search'));

        $data = [
            'logs' => $paginate['itens'],
            'pager' => $paginate['pager']
        ];

        $data['title'] = 'Log (' . $paginate['total'] . ')';
        return \Config\Services::template()->templatePainel($data);
    }

}
