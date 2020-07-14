<?php

namespace System\Validation;

use \CodeIgniter\HTTP\Exceptions\HTTPException;
use \Config\Services;
use function \env;
use function \lang;

/**
 * Description of Auth
 *
 * @author Romário Beckman
 */
class SysValidation {

    function sys_grecaptcha(string $str, string &$error = null) {
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

            \System\Config\Sys::$log['recaptcha'] = $json;

            if ($json->success ?? false) {
                return $json->score >= (float) Services::sysRepository()->getConfiguration('RECAPTCHA_V3_MINIMUM_SCORE');
            }

            return false;
        } catch (HTTPException $exc) {
            return false;
        }
    }

}
