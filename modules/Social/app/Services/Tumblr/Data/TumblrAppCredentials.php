<?php

declare(strict_types=1);

namespace Modules\Social\Services\Tumblr\Data;

use Spatie\LaravelData\Data;

final class TumblrAppCredentials extends Data
{
    public function __construct(
        public string $key,
        public ?string $secret = null
    ) {
    }
}
