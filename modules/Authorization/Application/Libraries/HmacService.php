<?php

namespace Authorization\Application\Libraries;

use \Config\Encryption;

class HmacService {

    private function getSalt(): ?string {
        return env('encryption.salt');
    }

    public function hash(string $text): string {
        $config = new Encryption();
        $hash = hash_hmac($config->digest, $text, $this->getSalt());
        return password_hash($hash, PASSWORD_ARGON2ID);
    }

    public function validateHash(string $text, string $textHashed): bool {
        $config = new Encryption();
        $hash = hash_hmac($config->digest, $text, $this->getSalt());
        return password_verify($hash, $textHashed);
    }

}
