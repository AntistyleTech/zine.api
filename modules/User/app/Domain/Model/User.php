<?php

declare(strict_types=1);

namespace Modules\User\Domain\Model;

use Services\Data\Register;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

final class User extends Data
{
    public function __construct(
        public ?int $id,
        public Lazy|Contact $contact,
        /** @var Lazy|array<Contact> */
        public Lazy|array $contacts,
        public Lazy|Account $account,
        /** @var Lazy|array<Account> */
        public Lazy|array $accounts,
    ) {
    }

    public static function register(Register $register): self
    {
        return new self();
    }
}
