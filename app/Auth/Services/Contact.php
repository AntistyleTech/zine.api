<?php

declare(strict_types=1);

namespace App\Auth\Services;

use Spatie\LaravelData\Data;

final class Contact extends Data
{
    public function __construct(
        ContactType $type,

    ) {
    }
}
