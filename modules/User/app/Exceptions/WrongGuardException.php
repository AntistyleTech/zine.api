<?php

declare(strict_types=1);

namespace Modules\User\Exceptions;

use App\Exceptions\LogicException;

final class WrongGuardException extends LogicException
{
    public function __construct(
        string $expected = '',
        string $provided = ''
    ) {
        parent::__construct("Wrong Guard expected: {$expected} provided: {$provided}");
    }
}
