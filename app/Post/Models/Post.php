<?php

namespace App\Post\Models;

use App\Account\Models\Account;
use App\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Post extends Model
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
}
