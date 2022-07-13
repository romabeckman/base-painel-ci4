<?php

namespace App\Services\Templates;

use \Config\Services;
use function \env;

/**
 * Description of Template
 *
 * @author Romário Beckman
 */
class LoginTemplate extends BaseTemplate {

    protected function customResources(): void {
        $this->resouces
                ->addJs('jquery')
                ->addJs('popperjs')
                ->addJs('bootstrap');
        $this->resouces
                ->addCss('bootstrap')
                ->addCss('fontawesome')
                ->addCss('painel_signin');
    }

    /**
     *
     * @param array $params
     * @param string|null $view
     * @return string
     */
    protected function customParams(array $params): array {
        !isset($params['title']) && $params['title'] = 'Login';
        $params['reCaptchaV3Api'] = env('GOOGLE_RECAPTCHA_V3_PUBLIC_KEY');
        $params['reCaptchaV2Api'] = env('GOOGLE_RECAPTCHA_V2_PUBLIC_KEY');
        $params['alertMessage'] = Services::alertMessages()->getMessage();
        return $params;
    }

}
