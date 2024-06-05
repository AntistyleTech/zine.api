<?php

declare(strict_types=1);

namespace Modules\Category\Services;

use Modules\Category\Models\Tag;
use Modules\Category\Services\Data\TagData;

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
