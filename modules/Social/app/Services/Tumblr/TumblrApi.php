<?php

declare(strict_types=1);

namespace Modules\Social\Services\Tumblr;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use Modules\Social\Services\Tumblr\Data\TumblrNeuePostData;

final class TumblrApi
{
    public function __construct(
        private AbstractProvider $provider
    ) {
    }

    private function client(): ClientInterface
    {
        return $this->provider->getHttpClient();
    }

    public function providerState(): string
    {
        return $this->provider->getState();
    }

    public function getAuthorizationUrl(array $options = []): string
    {
        return $this->provider->getAuthorizationUrl($options);
    }

    public function getAccessToken(string $grant, string $code): AccessToken
    {
        return $this->provider->getAccessToken($grant, ['code' => $code]);
    }

    public function posts(AccessToken $token, TumblrNeuePostData $postData)
    {
        $blogIdentifier = $token->getResourceOwnerId();

        $requestUrl = "https://api.tumblr.com/v2/blog/$blogIdentifier/posts";

        $response = $this->client()->post($requestUrl, [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Content-Type' => 'application/json'
            ],
            RequestOptions::JSON => $postData->toArray(),
        ]);

        return $response->getBody()->getContents();
    }
}
