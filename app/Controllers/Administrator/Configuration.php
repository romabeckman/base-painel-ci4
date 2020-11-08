<?php

namespace App\Controllers\Administrator;

use \Config\Services;
use \Shared\Application\Abstracts\ControllerBase;
use \System\Config\Services as SystemServices;
use function \env;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class Configuration extends ControllerBase {

    public function index() {
        $recaptchav3 = env('GOOGLE_RECAPTCHA_V3_PUBLIC_KEY');

        $data = [
            'configuration' => SystemServices::repository()->getAllConfiguration(),
            'recaptchav3' => !empty($recaptchav3),
            'recatchaScore' => array_combine(range(0, 1, 0.1), range(0, 1, 0.1))
        ];

        $data['title'] = 'Configuração';
        return Services::template()->templatePainel($data, 'index');
    }

    public function save() {
        $post = $this->request->getPost();
        if (empty($post)) {
            return $this->response->redirect('/administrator/configuration');
        }

        SystemServices::repository()->saveConfiguration($post);
        Services::alertMessages()->setMsgSuccess('Configurações atualizadas com sucesso!');
        return $this->response->redirect('/administrator/configuration');
    }

}
