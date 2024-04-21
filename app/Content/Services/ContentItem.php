<?php

declare(strict_types=1);

namespace App\Content\Services;

use Spatie\LaravelData\Data;

abstract class ContentItem extends Data
{
    public function __construct(
        public ContentItemType $type,
        public mixed $data
    ) {
    }
}
