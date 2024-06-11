<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\User\Database\Factories\ContactFactory;

/**
 * @mixin IdeHelperContact
 */
class Contact extends Model
{
//    use HasFactory;

//    /**
//     * The attributes that are mass assignable.
//     */
//    protected $fillable = [];
//
//    protected static function newFactory(): ContactFactory
//    {
//        return ContactFactory::new();
//    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeVerified(Builder $query): void
    {
        $query->where('verified_at', 'IS NOT', null);
    }
}
