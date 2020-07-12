<?php

namespace Authorization\Services;

use \Config\Encryption;

class HmacService {

    public function hash(string $text): string {
        $config = new Encryption();
        $hash = hash_hmac($config->digest, $text, $config->salt);
        return password_hash($hash, PASSWORD_ARGON2ID);
    }

    public function validateHash(string $text, string $textHashed): bool {
        $config = new Encryption();
        $hash = hash_hmac($config->digest, $text, $config->salt);
        return password_verify($hash, $textHashed);
    }

}
