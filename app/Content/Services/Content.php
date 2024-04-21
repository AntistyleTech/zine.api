<?php

declare(strict_types=1);

namespace App\Content\Services;

abstract class Content
{
    public ContentType $type;
    public ContentStatus $status;

    /** @var ContentItem[] */
    public array $items;
}
