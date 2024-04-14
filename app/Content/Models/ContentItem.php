<?php

namespace App\Content\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentItem extends Model
{
    use HasFactory;

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
