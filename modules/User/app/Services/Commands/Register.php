<?php

declare(strict_types=1);

namespace Modules\User\Services\Commands;

use Spatie\LaravelData\Data;

final class Register extends Data
{
    public function __construct(
        public string $username,
        public string $email,
        public string $password,
    ) {
    }
}
