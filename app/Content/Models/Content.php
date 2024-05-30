<?php

namespace App\Content\Models;

use App\Auth\Models\User;
use App\Category\Models\Category;
use App\Category\Models\Tag;
use App\User\Models\Account;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Content extends Model
{
    use HasFactory;

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, Account::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function category(): MorphOne
    {
        return $this->morphOne(Category::class, 'categorisable')
            ->ofMany(function (Builder $query) {
                $query->where('categorisable.is_main', '=', 1);
            });
    }

    public function categories(): MorphMany
    {
        return $this->morphMany(Category::class, 'categorisable');
    }

    public function tags(): MorphMany
    {
        return $this->morphMany(Tag::class, 'taggable');
    }
}
