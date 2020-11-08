<?php

namespace App\Controllers\Administrator;

use \Config\Services;
use \Shared\Application\Abstracts\ControllerBase;
use \System\Config\Services as SystemServices;
use function \helper;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class Log extends ControllerBase {

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
