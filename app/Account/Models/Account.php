<?php

namespace App\Account\Models;

use App\Auth\Models\User;
use App\Content\Models\Content;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Account extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    public function settings(): HasMany
    {
        return $this->hasMany(Settings::class);
    }

    public function currentSettings(): HasOne
    {
        return $this->hasOne(Settings::class, 'id', 'current_settings')->ofMany();
    }
}
