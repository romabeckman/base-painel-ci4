<?php

if (!function_exists('aesEncrypt')) {

    function aesEncrypt(string $input = '?', string $key = '@key'): string {
        if ($input != '?') {
            $db = \Config\Database::connect();
            $input = $db->escape($input);
        }
        return "AES_ENCRYPT({$input}, {$key})";
    }

}

if (!function_exists('aesDecrypt')) {

    function aesDecrypt(string $field, string $as = '', string $key = '@key'): string {
        return "AES_DECRYPT({$field}, {$key})" . (empty($as) ? '' : ' as ' . $as);
    }

}