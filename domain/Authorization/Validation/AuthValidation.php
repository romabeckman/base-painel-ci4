<?php

namespace Authorization\Validation;

use \Authorization\Config\Auth;
use \Authorization\Config\Services as ServicesAuth;

/**
 * Description of Auth
 *
 * @author Romário Beckman
 */
class AuthValidation {

    function auth_current_password(string $str, string &$error = null) {
        return ServicesAuth::authHmac()->validateHash($str, Auth::$user->password);
    }

    function auth_strong_password(string $str, string &$error = null) {
//        return (bool) preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/', $str);
        return (bool) preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $str);
    }
}
