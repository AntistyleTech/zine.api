<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Category\Models\Traits\Categorisable;
use Modules\Category\Models\Traits\Taggable;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use Categorisable, Taggable;

    protected $fillable = ['account_id', 'title', 'data'];

    //    use HasFactory;
    //
    //    /**
    //     * The attributes that are mass assignable.
    //     */
    //    protected $fillable = [];
    //
    //    protected static function newFactory(): PostFactory
    //    {
    //        return PostFactory::new();
    //    }

    public function contentItems(): HasMany
    {
        return $this->hasMany(ContentItem::class);
    }

}
