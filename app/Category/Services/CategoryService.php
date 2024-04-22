<?php

declare(strict_types=1);

namespace App\Category\Services;

use App\Category\Models\Category;
use App\Category\Services\Data\CategoryData;

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
