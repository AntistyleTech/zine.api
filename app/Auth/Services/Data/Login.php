<?php

declare(strict_types=1);

namespace App\Auth\Services\Data;

use Spatie\LaravelData\Data;

final class Login extends Data
{
    public function __construct(
        public ?string $username,
        public ?string $email,
        public string $password,
    ) {
    }
}
