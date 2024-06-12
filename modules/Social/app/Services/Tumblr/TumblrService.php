<?php

declare(strict_types=1);

namespace Modules\Social\Services\Tumblr;

use Modules\Social\Services\Tumblr\Data\TumblrNeuePostData;

final class TumblrService
{
    public function __construct(private TumblrApi $tumblrApi)
    {
    }

    public function posts(TumblrNeuePostData $post)
    {
        $this->tumblrApi->posts($post->toArray(), $tumblrUser);
    }
}
