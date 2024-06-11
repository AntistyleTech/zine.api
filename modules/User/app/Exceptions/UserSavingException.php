<?php

declare(strict_types=1);

namespace Modules\User\Exceptions;

use App\Exceptions\LogicException;
use Throwable;

final class UserSavingException extends LogicException
{
    public function __construct(string $message = 'UserSavingException')
    {
        parent::__construct($message);
    }
}
