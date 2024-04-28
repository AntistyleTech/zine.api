<?php

declare(strict_types=1);

namespace App\Content\Services\Data;

use App\Content\Services\Data\enum\ContentItemType;
use Spatie\LaravelData\Data;

final class ContentItem extends Data
{
    public function __construct(
        public ContentItemType $type,
        public mixed $data
    ) {
    }
}
