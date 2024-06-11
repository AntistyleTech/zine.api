<?php

declare(strict_types=1);

namespace Modules\User\Services\Commands;

use Modules\User\Services\Data\ContactData;
use Spatie\LaravelData\Data;

final class SearchUser extends Data
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public ?ContactData $contact = null
    ) {
    }
}
