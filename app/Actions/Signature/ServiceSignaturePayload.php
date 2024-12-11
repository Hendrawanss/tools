<?php

declare(strict_types=1);

namespace App\Actions\Signature;

class ServiceSignaturePayload
{
    public function __construct(
        protected string $httpMethod,
        protected string $endpointUrl,
        protected string $accessToken,
        protected string $timestamp,
        protected array|string $payload = ''
    ) {
        //
    }

    public function __toString()
    {
        $json = is_array($this->payload)
            ? json_encode($this->payload)
            : $this->payload;

        $minified = hash('sha256', $json);

        $values = [
            $this->httpMethod,
            $this->endpointUrl,
            $this->accessToken,
            $minified,
            (string) new Timestamp($this->timestamp),
        ];

        if (Config::serviceSignatureIsAsymmetric()) {
            unset($values[2]);
        }

        $stringToSign = implode(':', $values);

        return $stringToSign;
    }
}
