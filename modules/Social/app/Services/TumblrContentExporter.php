<?php

declare(strict_types=1);

namespace Modules\Social\Services;

use App\Interfaces\Content\Content;
use Modules\Social\Models\SocialAccount;
use Modules\Social\Services\Tumblr\Data\TumblrNeuePostData;
use Modules\Social\Services\Tumblr\TumblrService;

final class TumblrContentExporter
{
    private TumblrService $service;

    public function __construct(private SocialAccount $account)
    {
        $this->service = app(TumblrService::class);
    }

    public function export(Content $content, SocialAccount $account)
    {
        $account = $account->data;
        $this->service->posts();
    }

    private function convert(Content $content)
    {
        return new TumblrNeuePostData();
    }
}
