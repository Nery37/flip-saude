<?php

declare(strict_types=1);

namespace App\Exceptions;

abstract class RequestException extends \RuntimeException
{
    private int $statusCode;

    public function __construct(string $message, int $statusCode)
    {
        parent::__construct($message, $statusCode);

        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
