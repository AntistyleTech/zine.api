<?php

declare(strict_types=1);

namespace Modules\Social\Services\Tumblr\Data;

use Spatie\LaravelData\Data;

final class TumblrNeuePostData extends Data
{
    /** @var $content TumblrNeueContentItemData[] */
    public array $content;

    public function toArray(): array
    {
        return [
            "content" => [
                [
                    "type" => "image",
                    "media" => [
                        [
                            "type" => "image/jpeg",
                            "url" => "https://images.unsplash.com/photo-1718049720096-7f1af82d69af?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                            "width" => "1280",
                            "height" => "1073",
                        ]
                    ],
                ]
            ]
        ];
    }
}
