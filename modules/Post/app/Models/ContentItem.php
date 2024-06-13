<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperContentItem
 */
class ContentItem extends Model
{
    //    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    //    protected static function newFactory(): ContentItemFactory
    //    {
    //        //return ContentItemFactory::new();
    //    }
}
