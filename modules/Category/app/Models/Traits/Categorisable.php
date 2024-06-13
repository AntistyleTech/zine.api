<?php

declare(strict_types=1);

namespace Modules\Category\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Category\Models\Category;

trait Categorisable
{
    public function category(): MorphOne
    {
        return $this->morphOne(Category::class, 'categorisable')
            ->ofMany('is_main', 'max');
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorisable');
    }
}
