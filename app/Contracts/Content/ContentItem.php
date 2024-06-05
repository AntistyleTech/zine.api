<?php

declare(strict_types=1);

namespace App\Contracts\Content;

use App\Contracts\Content\Enum\ContentItemType;
use Spatie\LaravelData\Data;

abstract class ContentItem extends Data
{
    public function __construct(
        public ContentItemType $type,
        public mixed $data
    ) {
    }
}
