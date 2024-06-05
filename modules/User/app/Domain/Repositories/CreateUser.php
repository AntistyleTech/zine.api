<?php

declare(strict_types=1);

namespace Modules\User\Domain\Repositories;

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
