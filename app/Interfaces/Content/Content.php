<?php

declare(strict_types=1);

namespace App\Interfaces\Content;

use App\Interfaces\Content\Enum\ContentType;

interface Content
{
    public function type(): ContentType;

    /** @return ContentItem[] */
    public function items(): array;
}
