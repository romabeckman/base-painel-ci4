<?php

namespace App\Validation;

use \CodeIgniter\HTTP\Exceptions\HTTPException;
use \Config\Services;
use \System\Config\Services as SystemServices;
use \System\Config\System;
use function \env;

/**
 * Description of ReCaptcha
 *
 * @author Romário Beckman
 */
class GoogleRecaptchaValidation {

    function grecaptchav3(string $str, string &$error = null): bool {
        $secret = env('GOOGLE_RECAPTCHA_V3_PRIVATE_KEY');
        if (empty($secret)) {
            return true;
        }

        $response = $this->curl($str, $secret);

        System::$log['recaptchav3'] = $response;

        if ($response->success ?? false) {
            return $response->score >= (float) SystemServices::repository()->getConfiguration('RECAPTCHA_V3_MINIMUM_SCORE');
        }

        return false;
    }

    function grecaptchav2(string $str, string &$error = null): bool {
        $secret = env('GOOGLE_RECAPTCHA_V2_PRIVATE_KEY');
        if (empty($secret)) {
            return true;
        }

        $response = $this->curl($str, $secret);

        System::$log['recaptchav2'] = $response;

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
