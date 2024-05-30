<?php

declare(strict_types=1);

namespace App\Content\Services\Exporters;

use App\Account\Services\Data\AccountData;
use App\Content\Services\Data\Content;
use App\Content\Services\Data\ContentExport;
use App\Social\Services\Tumblr\TumblrService;

final class TumblrContentExporter implements ContentExporter
{
    public function __construct(private TumblrService $tumblrService)
    {

    }

    public function export(AccountData $account, Content $content, mixed $target): ContentExport
    {
        $this->tumblrService->createPost();
    }
}
