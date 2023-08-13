<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * For 401 errors.
 */
class UnauthorizedException extends ClientException
{
    public const HTTP_STATUS = 401;

    public function __construct(string $message, array $body = [], array $headers = [])
    {
        parent::__construct($message, self::HTTP_STATUS, $body, $headers);
    }
}
