<?php

namespace App\Controllers\Administrator;

use \App\Controllers\BaseController;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class Configuration extends BaseController {

    public function index() {
        $recaptchav3 = env('GOOGLE_RECAPTCHA_V3_PUBLIC_KEY');

        $data = [
            'configuration' => \System\Config\Services::sysRepository()->getAllConfiguration(),
            'recaptchav3' => !empty($recaptchav3),
            'recatchaScore' => array_combine(range(0, 1, 0.1), range(0, 1, 0.1))
        ];

        $data['title'] = 'Configuração';
        return \Config\Services::template()->templatePainel($data, 'index');
    }

    public function save() {
        $post = $this->request->getPost();
        if (empty($post)) {
            return $this->response->redirect('/administrator/configuration');
        }

        \System\Config\Services::sysRepository()->saveConfiguration($post);
        \Config\Services::alertMessages()->setMsgSuccess('Configurações atualizadas com sucesso!');
        return $this->response->redirect('/administrator/configuration');
    }

}
