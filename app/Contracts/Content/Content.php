<?php

declare(strict_types=1);

namespace App\Contracts\Content;

use App\Contracts\Content\Enum\ContentType;

interface Content
{
    public function type(): ContentType;

    /** @return ContentItem[] */
    public function items(): array;
}
