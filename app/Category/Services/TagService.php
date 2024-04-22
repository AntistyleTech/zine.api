<?php

declare(strict_types=1);

namespace App\Category\Services;

use App\Category\Models\Tag;
use App\Category\Services\Data\TagData;

final class TagService
{
    /**
     * @return TagData[]
     */
    public function all(): array
    {
        return TagData::collect(Tag::all())->all();
    }
}
