<?php

namespace Authorization\Validation;

use \CodeIgniter\HTTP\Exceptions\HTTPException;
use \Config\Services;
use \System\Services\ConfigurationService;
use function \env;
use function \lang;

/**
 * Description of Auth
 *
 * @author Romário Beckman
 */
class Auth {

    function auth_grecaptcha(string $str, string &$error = null) {
        $error = lang('Auth.invalid_user_captcha');

        try {
            $response = Services::curlrequest()->post('https://www.google.com/recaptcha/api/siteverify', [
                'verify' => false,
                'form_params' => [
                    'secret' => env('GOOGLE_RECAPTCHA_PRIVATE_KEY'),
                    'response' => $str,
                    'remoteip' => Services::request()->getIPAddress()
                ]
            ]);

            $json = json_decode($response->getBody());

            if (json_last_error() != JSON_ERROR_NONE) {
                return false;
            }

            if ($json->success ?? false) {
                return $json->score >= (float) (new ConfigurationService)->get('RECAPTCHA_V3_MINIMUM_SCORE');
            }

            return false;
        } catch (HTTPException $exc) {
            return false;
        }
    }

}
