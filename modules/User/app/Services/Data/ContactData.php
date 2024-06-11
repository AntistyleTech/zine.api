<?php

declare(strict_types=1);

namespace Modules\User\Services\Data;

use DateTime;
use Modules\User\Enum\ContactType;
use Spatie\LaravelData\Data;

class ContactData extends Data
{
    public ?int $id = null;

    public function __construct(
        public ContactType $type,
        public string $value,
        public ?DateTime $confirmedAt = null
    ) {
    }

    public static function email(string $value): self
    {
        return new self(ContactType::Email, $value);
    }
}
