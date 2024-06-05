<?php

declare(strict_types=1);

namespace App\Contracts\Content;

use App\Contracts\Content\Enum\ContentStatus;
use App\Contracts\Content\Enum\ContentType;

abstract class Content
{
    public ContentType $type;
    public ContentStatus $status;

    /** @var ContentItem[] */
    public array $items;
}
