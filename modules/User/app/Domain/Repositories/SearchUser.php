<?php

declare(strict_types=1);

namespace Modules\User\Domain\Repositories;

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
