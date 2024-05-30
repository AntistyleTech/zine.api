<?php

declare(strict_types=1);

namespace App\Common\Services;

use Spatie\LaravelData\Data;

final class UserData extends Data
{
    public function __construct(
        public int $id,
        public string $username,
        public string $email,
        public ?array $data = null
    ) {
    }
}
