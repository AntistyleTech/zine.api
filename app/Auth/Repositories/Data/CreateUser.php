<?php

declare(strict_types=1);

namespace App\Auth\Repositories\Data;

use Spatie\LaravelData\Data;

final class CreateUser extends Data
{
    public function __construct(
        public string $username,
        public string $email,
        public string $password
    ) {
    }
}
