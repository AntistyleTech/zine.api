<?php

declare(strict_types=1);

namespace Modules\User\Exceptions;

use App\Exceptions\LogicException;

final class UsernameAlreadyInUse extends LogicException
{
    public function __construct(string $username)
    {
        parent::__construct("Username {$username} already in use");
    }
}
