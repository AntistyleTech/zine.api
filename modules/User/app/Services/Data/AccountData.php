<?php

declare(strict_types=1);

namespace Modules\User\Services\Data;

use Spatie\LaravelData\Data;

final class AccountData extends Data
{
    public ?int $id = null;

    public function __construct(
        public string $username
    ) {
    }
}
