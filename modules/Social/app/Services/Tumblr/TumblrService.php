<?php

declare(strict_types=1);

namespace Modules\Social\Services\Tumblr;

use Illuminate\Http\JsonResponse;
use League\OAuth1\Client\Server\Server;
use League\OAuth1\Client\Server\Tumblr;
use Modules\Social\Services\Tumblr\Data\TumblrAppCredentials;

final class TumblrService
{
    private Server $server;

    public function __construct(TumblrAppCredentials $credentials)
    {
        $this->server = new Tumblr([
            'identifier' => $credentials->key,
            'secret' => $credentials->secret,
            'callback_uri' => 'http://your-callback-uri/',
        ]);
    }

    public function test(): JsonResponse
    {
        $temporary = $this->server->getTemporaryCredentials();

        $data = [
            $temporary->getIdentifier(),
            $temporary->getSecret(),
        ];

        return response()->json($data);

    }

    public function createPost(string $blogName, $data)
    {
        return $this->client->createPost($blogName, $data);
    }
}
