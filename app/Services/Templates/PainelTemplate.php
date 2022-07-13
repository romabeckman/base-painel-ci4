<?php

namespace App\Services\Templates;

use \System\Config\Services;

/**
 * Description of Template
 *
 * @author Romário Beckman
 */
class PainelTemplate extends BaseTemplate {

    protected function customResources(): void {
        $this->resouces
                ->addJs('jquery')
                ->addJs('popperjs')
                ->addJs('bootstrap')
                ->addJs('painel_main');
        $this->resouces
                ->addCss('bootstrap')
                ->addCss('fontawesome')
                ->addCss('painel_main');
    }

    /**
     *
     * @param array $params
     * @param string|null $view
     * @return string
     */
    protected function customParams(array $params): array {
        !isset($params['title']) && $params['title'] = 'Login';
        $params['alertMessage'] = Services::alertMessages()->getMessage();
        return $params;
    }

}
