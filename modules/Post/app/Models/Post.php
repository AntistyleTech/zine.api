<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Models\Traits\Categorisable;
use Modules\Category\Models\Traits\Taggable;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use Categorisable, Taggable;

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

}
