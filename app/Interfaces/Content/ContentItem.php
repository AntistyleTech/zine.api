<?php

declare(strict_types=1);

namespace App\Interfaces\Content;

use App\Interfaces\Content\Enum\ContentItemType;

interface ContentItem
{
    public function type(): ContentItemType;

    public function data(): mixed;
}
