<?php

declare(strict_types=1);

namespace Modules\ContentExport\Services;

use App\Interfaces\Content\Content;
use Modules\Social\Enum\SocialNetwork;
use Modules\Social\Services\Tumblr\TumblrService;

class ContentExportService
{
    public function export(Content $content, mixed $target)
    {
        $socialServiceClass = match ($target->account->socialNetwork) {
            SocialNetwork::Tumblr => TumblrService::class,
            //SocialNetwork::Twitter => TwitterService::class,
        };


    }
}
