<?php

declare(strict_types=1);

namespace App\Actions\Signature;

use Exception;
use OpenSSLAsymmetricKey;

class PrivateKey
{
    protected OpenSSLAsymmetricKey|bool|null $value = null;

    public function __construct(protected ?string $content = null, protected ?string $path = null)
    {
        if (! $this->validate()) {
            throw new Exception('Private key not valid.');
        }
    }

    protected function getContent(): string
    {
        return $this->content ?? file_get_contents($this->path);
    }

    protected function validate(): bool
    {
        $this->value = openssl_get_privatekey($this->getContent());

        return $this->value === false ? false : true;
    }

    public function value(): OpenSSLAsymmetricKey
    {
        return openssl_get_privatekey($this->getContent());
    }

    public function __toString()
    {
        return $this->getContent();
    }
}
