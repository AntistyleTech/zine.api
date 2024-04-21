<?php

declare(strict_types=1);

namespace App\Post\Services\Data;

use App\Content\Services\Lang;
use Spatie\LaravelData\Data;

final class SearchPosts extends Data
{
    public function __construct(
        public ?array $username,
        public ?array $categories,
        public Lang $lang = Lang::English
    ) {
    }
}
