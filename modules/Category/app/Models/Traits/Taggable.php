<?php

declare(strict_types=1);

namespace Modules\Category\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Category\Models\Tag;

trait Taggable
{
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
