<?php

declare(strict_types=1);

namespace App\Auth\Services;

use App\Auth\Services\Data\Register;
use Illuminate\Support\LazyCollection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

final class User extends Data
{
    public function __construct(
        public ?int $id,
        public string $username,
        public Lazy|Contact $contact,
        public Lazy|Account $account,
        /**
         * @var LazyCollection<Account>
         */
        public LazyCollection $accounts,
    ) {
    }

    public static function register(Register $register): self
    {
        return new self();
    }
}
