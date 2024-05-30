<?php

namespace App\Common;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

abstract class LogicException extends Exception implements HttpExceptionInterface
{
    public function __construct(
        string $message = 'LogicException',
        protected int $httpCode = 500,
        int $code = 0,
        protected ?Throwable $previous = null
    ) {
        // TODO: Check ability to add Laravel ContextData to exception report
        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->httpCode;
    }

    public function getHeaders(): array
    {
        return [];
    }
}
