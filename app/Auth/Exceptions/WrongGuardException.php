<?php

declare(strict_types=1);

namespace App\Auth\Exceptions;

use App\LogicException;

final class WrongGuardException extends LogicException
{
    public function __construct(string $expected = '', string $provided = '')
    {
        parent::__construct("Wrong Guard expected: {$expected} provided: {$provided}");
    }
}
