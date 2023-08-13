<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * For 4xx errors.
 */
class ClientException extends RequestException
{
    private array $body;
    private array $headers;

    public function __construct(string $message, int $statusCode, array $body, array $headers)
    {
        parent::__construct($message, $statusCode);

        $this->body = $body;
        $this->headers = $headers;
    }

    public function getResponseBody(): array
    {
        return $this->body;
    }

    public function getResponseHeaders(): array
    {
        return $this->headers;
    }
}
