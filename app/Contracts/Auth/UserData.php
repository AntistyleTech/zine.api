<?php

declare(strict_types=1);

namespace App\Contracts\Auth;

use Spatie\LaravelData\Data;

final class UserData extends Data
{
    public function __construct(
        public int $userId,
        public int $accountId,
        /** @var int[] $accounts */
        public array $accounts
    ) {
    }
}
