<?php

declare(strict_types=1);

namespace App\Account\Services\Data;

use Spatie\LaravelData\Data;

final class AccountData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }
}
