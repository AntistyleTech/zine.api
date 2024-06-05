<?php

declare(strict_types=1);

namespace Modules\Category\Services\Data;

use Spatie\LaravelData\Data;

final class TagData extends Data
{
    public function __construct(
        public int $id,
        public string $title
    ) {
    }
}
