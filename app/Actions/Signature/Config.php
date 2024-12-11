<?php

declare(strict_types=1);

namespace App\Actions\Signature;

use Psr\Log\LoggerInterface;

class Config
{
    protected static $serviceSignatureMode = 'symmetric';

    public function __construct()
    {
        //
    }

    public static function serviceSignatureUseAsymmetric(): void
    {
        static::$serviceSignatureMode = 'asymmetric';
    }

    public static function serviceSignatureUseSymmetric(): void
    {
        static::$serviceSignatureMode = 'symmetric';
    }

    public static function serviceSignatureIsAsymmetric(): bool
    {
        return static::$serviceSignatureMode == 'asymmetric';
    }

    public static function serviceSignatureIsSymmetric(): bool
    {
        return static::$serviceSignatureMode == 'symmetric';
    }
}
