<?php

namespace App\Validation;

use \Config\Database;

/**
 * Description of PainelValidation
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
class PainelValidation {

    function phone_br(string $str, string &$error = null): bool {
        if (empty($str)) {
            return true;
        }

        return (bool) preg_match('/\([0-9]{2}\) [0-9]{5}\-[0-9]{4}/', $str);
    }

}
