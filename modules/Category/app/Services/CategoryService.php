<?php

declare(strict_types=1);

namespace Modules\Category\Services;

use Modules\Category\Models\Category;
use Modules\Category\Services\Data\CategoryData;

final class CategoryService
{
    /**
     * @return CategoryData[]
     */
    public function all(): array
    {
        return CategoryData::collect(Category::all())->all();
    }
}
