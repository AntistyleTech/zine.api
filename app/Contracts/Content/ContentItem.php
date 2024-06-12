<?php

declare(strict_types=1);

namespace App\Contracts\Content;

use App\Contracts\Content\Enum\ContentItemType;

interface ContentItem
{
    public function type(): ContentItemType;

    public function data(): mixed;
}
