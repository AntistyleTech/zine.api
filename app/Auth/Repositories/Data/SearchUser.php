<?php

declare(strict_types=1);

namespace App\Auth\Repositories\Data;

use Spatie\LaravelData\Data;

final class SearchUser extends Data
{
    public function __construct(
        public ?int $id = null,
        public ?string $username = null,
        public ?string $email = null
    ) {
    }
}
