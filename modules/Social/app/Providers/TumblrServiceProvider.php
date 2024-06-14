<?php

namespace Modules\Social\Providers;

use Illuminate\Support\ServiceProvider;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\GenericProvider;
use Modules\Social\Services\Tumblr\TumblrApi;

class TumblrServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function boot(): void
    {
        $this->app->when([TumblrApi::class])
            ->needs(AbstractProvider::class)
            ->give(fn() => $this->resolveAuthProvider());
    }

    private function resolveAuthProvider(): AbstractProvider
    {
        $redirectDomain = $this->app->isLocal()
            ? config('tunnelDomain')
            : config('app.url');

        $options = [
            'clientId' => config('service.tumblrApp.clientId'),
            'clientSecret' => config('service.tumblrApp.clientSecret'),
            'redirectUri' => $redirectDomain.'/api/social/tumblr/auth_confirmed',
            'urlAuthorize' => 'https://www.tumblr.com/oauth2/authorize',
            'urlAccessToken' => 'https://api.tumblr.com/v2/oauth2/token',
            'urlResourceOwnerDetails' => 'https://api.tumblr.com/v2/user/info'
        ];

        return new GenericProvider($options);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
