<?php

namespace App\Validation;

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

    public function is_unique_decrypted(string $str = null, string $field, array $data): bool {
        list($field, $ignoreField, $ignoreValue) = array_pad(explode(',', $field), 3, null);

        // Break the table and field apart
        sscanf($field, '%[^.].%[^.]', $table, $field);

        $db = \Config\Database::connect($data['DBGroup'] ?? null);

        $str = $db->escapeString($str);

        $row = $db->table($table)
                ->select('1')
                ->where($field, aesEncrypt($str), false)
                ->limit(1);

        if (!empty($ignoreField) && !empty($ignoreValue)) {
            if (!preg_match('/^\{(\w+)\}$/', $ignoreValue)) {
                $row = $row->where("{$ignoreField} !=", $ignoreValue);
            }
        }

        return (bool) ($row->get()
                        ->getRow() === null);
    }

}
