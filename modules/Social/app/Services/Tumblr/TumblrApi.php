<?php

declare(strict_types=1);

namespace Modules\Social\Services\Tumblr;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use Modules\Social\Services\Tumblr\Data\TumblrNeuePostData;

final class TumblrApi
{
//    private Client $client;
//    private string $tumblrUri = 'https://www.tumblr.com';
//    private string $tumblrUri = 'https://api.tumblr.com';

    public function __construct(
        private AbstractProvider $provider,
        private Client $client
    ) {
//        $this->client = new Client(['base_uri' => $this->tumblrUri]);
    }

    public function getAuthUrl(array $options): string
    {
        return $this->provider->getAuthorizationUrl($options);
    }

    public function posts(AccessToken $token, TumblrNeuePostData $postData)
    {
        $blogIdentifier = $token->getResourceOwnerId();

        $requestUrl = "https://api.tumblr.com/v2/blog/$blogIdentifier/posts";

        $response = $this->client->post($requestUrl, [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Content-Type' => 'application/json'
            ],
            RequestOptions::JSON => $postData->toArray(),
        ]);

        return $response->getBody()->getContents();
    }
}
