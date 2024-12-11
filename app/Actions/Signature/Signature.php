<?php

namespace App\Actions\Signature;

use Exception;

class Signature
{
    public static function asymmetric(PrivateKey $privateKey, ServiceSignaturePayload $data): string
    {
        $signature = null;

        openssl_sign((string) $data, $signature, $privateKey->value(), 'RSA-SHA256');

        if (! $signature) {
            throw new Exception('Signature is invalid.');
        }

        return base64_encode($signature);
    }
}