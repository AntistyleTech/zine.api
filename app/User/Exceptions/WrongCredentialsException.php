<?php

declare(strict_types=1);

namespace App\Auth\Exceptions;

use App\Common\LogicException;

final class WrongCredentialsException extends LogicException
{
    public function __construct()
    {
        parent::__construct('Credentials are not attempted', 401);
    }
}
