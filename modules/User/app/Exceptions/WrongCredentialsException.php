<?php

declare(strict_types=1);

namespace Modules\User\Exceptions;

use App\Common\Exceptions\LogicException;

final class WrongCredentialsException extends LogicException
{
    public function __construct()
    {
        parent::__construct('Credentials are not attempted', 401);
    }
}
