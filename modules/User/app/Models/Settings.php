<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperSettings
 */
class Settings extends Model
{
//    use HasFactory;
    protected $guarded = [];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
