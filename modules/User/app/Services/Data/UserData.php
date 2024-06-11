<?php

declare(strict_types=1);

namespace Modules\User\Services\Data;

use Spatie\LaravelData\Data;

final class UserData extends Data
{
    public ?int $id = null;

    public function __construct(
        public AccountData $account,
        public ContactData $contact,
        public string $password,
        public bool $verified,
        /** @var AccountData[] */
        public array $accounts,
        /** @var ContactData[] */
        public array $contacts
    ) {
    }
}
