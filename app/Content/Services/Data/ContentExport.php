<?php

declare(strict_types=1);

namespace App\Content\Services\Data;

use Spatie\LaravelData\Data;

final class ContentExport extends Data
{
    public function __construct(
        public Content $content,
        public mixed $target
    ) {
    }
}
