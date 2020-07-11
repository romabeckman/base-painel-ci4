<?php

if (!function_exists('aesEncrypt')) {

    function aesEncrypt(string $input, string $key = '@key'): string {
        return "AES_ENCRYPT('{$input}', {$key})";
    }

}

if (!function_exists('aesDecrypt')) {

    function aesDecrypt(string $field, string $key = '@key'): string {
        return "AES_DECRYPT({$field}, {$key}) as {$field}";
    }

}