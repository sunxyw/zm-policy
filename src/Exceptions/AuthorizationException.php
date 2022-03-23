<?php

namespace Sunxyw\Policy\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class AuthorizationException extends Exception
{
    #[Pure]
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        $message = $message ?: '你没有权限进行此操作。';
        parent::__construct($message, $code, $previous);
    }

    public function need(string $permission): self
    {
        $this->message = "你没有权限进行此操作，需要{$permission}权限。";
        return $this;
    }
}