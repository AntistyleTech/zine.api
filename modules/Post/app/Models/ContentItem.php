<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
