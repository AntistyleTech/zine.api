<?php

declare(strict_types=1);

namespace Modules\User\Services\Commands;

use Modules\User\Services\Data\ContactData;
use Spatie\LaravelData\Data;

final class Register extends Data
{
    public function __construct(
        public string $name,
        public ContactData $contact,
        public string $password
    ) {
    }
}
