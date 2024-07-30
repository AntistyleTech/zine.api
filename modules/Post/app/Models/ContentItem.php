<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperContentItem
 */
class ContentItem extends Model
{
    //    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['type', 'data'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    //    protected static function newFactory(): ContentItemFactory
    //    {
    //        //return ContentItemFactory::new();
    //    }
}
