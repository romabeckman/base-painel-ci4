<?php

namespace App\Controllers\Administrator;

use \Config\Services;
use \Shared\Application\Abstracts\BaseController;
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
        $paginate = SystemServices::logRepository()->getPaginated($this->request->getGet('search') ?: '', 'id desc');
        
        $data = [
            'logs' => $paginate['itens'],
            'pager' => $paginate['pager']
        ];

        $data['title'] = 'Log (' . $paginate['total'] . ')';
        return Services::template()->templatePainel($data);
    }

}
