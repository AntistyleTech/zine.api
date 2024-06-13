<?php

declare(strict_types=1);

namespace Modules\User\Services\Commands;

use Spatie\LaravelData\Data;

final class Login extends Data
{
    public function __construct(
        public string $login,
        public string $password,
    ) {
    }
}
