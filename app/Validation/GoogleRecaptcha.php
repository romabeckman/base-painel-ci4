<?php

namespace App\Validation;

use \CodeIgniter\HTTP\Exceptions\HTTPException;
use \Config\Services;

/**
 * Description of ReCaptcha
 *
 * @author Romário Beckman
 */
class GoogleRecaptcha {

    function grecaptchav3(string $str, string &$error = null): bool {
        $error = lang('Auth.invalid_user_captcha');

        $secret = env('GOOGLE_RECAPTCHA_V3_PRIVATE_KEY');
        if (empty($secret)) {
            return true;
        }

        $response = $this->curl($str, $secret);

        \System\Config\Sys::$log['recaptchav3'] = $response;

        if ($response->success ?? false) {
            return $response->score >= (float) Services::sysRepository()->getConfiguration('RECAPTCHA_V3_MINIMUM_SCORE');
        }

        return false;
    }

    function grecaptchav2(string $str, string &$error = null): bool {
        $error = lang('Auth.invalid_user_captcha');

        $secret = env('GOOGLE_RECAPTCHA_V2_PRIVATE_KEY');
        if (empty($secret)) {
            return true;
        }

        $response = $this->curl($str, $secret);

        \System\Config\Sys::$log['recaptchav2'] = $response;

        return $response->success ?? false;
    }

    private function curl(string $token, string $secret): ?object {
        try {
            $response = Services::curlrequest()->post('https://www.google.com/recaptcha/api/siteverify', [
                'verify' => false,
                'form_params' => [
                    'secret' => $secret,
                    'response' => $token,
                    'remoteip' => Services::request()->getIPAddress()
                ]
            ]);

            $json = json_decode($response->getBody());

            if (json_last_error() != JSON_ERROR_NONE) {
                return null;
            }

            return $json;
        } catch (HTTPException $exc) {
            return null;
        }
    }

}
