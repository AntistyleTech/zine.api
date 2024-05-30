<?php

declare(strict_types=1);

namespace App\Uer\Services\Commands;

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
