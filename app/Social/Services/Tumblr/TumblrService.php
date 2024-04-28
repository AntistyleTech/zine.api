<?php

declare(strict_types=1);

namespace App\Social\Services\Tumblr;

use App\Social\Services\Tumblr\Data\TumblrCredentials;
use Tumblr\API\Client;

final class TumblrService
{
    private Client $client;

    public function __construct(TumblrCredentials $credentials)
    {
        $this->client = new Client($credentials->key, $credentials->secret);
    }

    public function createPot(string $blogName, $data)
    {
        return $this->client->createPost($blogName, $data);
    }
}
