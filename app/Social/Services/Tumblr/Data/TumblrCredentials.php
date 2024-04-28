<?php

declare(strict_types=1);

namespace App\Social\Services\Tumblr\Data;

use Spatie\LaravelData\Data;

final class TumblrCredentials extends Data
{
    public function __construct(
        public string $key,
        public ?string $secret = null
    ) { }
}
