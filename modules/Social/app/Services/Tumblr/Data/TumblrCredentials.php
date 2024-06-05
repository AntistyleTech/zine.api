<?php

declare(strict_types=1);

namespace Modules\Social\app\Services\Tumblr\Data;

use Spatie\LaravelData\Data;

final class TumblrCredentials extends Data
{
    public function __construct(
        public string $key,
        public ?string $secret = null
    ) {
    }
}
