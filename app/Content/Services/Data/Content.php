<?php

declare(strict_types=1);

namespace App\Content\Services\Data;

use App\Content\Services\Data\enum\ContentStatus;
use App\Content\Services\Data\enum\ContentType;

final class Content
{
    public ContentType $type;
    public ContentStatus $status;

    /** @var ContentItem[] */
    public array $items;
}
