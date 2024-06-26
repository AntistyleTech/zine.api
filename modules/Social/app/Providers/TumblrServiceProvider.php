<?php

namespace Modules\Social\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\GenericProvider;
use Modules\Social\Services\Tumblr\Oauth2\TumblrProvider;
use Modules\Social\Services\Tumblr\TumblrApi;

class TumblrServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(\SocialiteProviders\Manager\ServiceProvider::class);
    }

    /**
     * Register the service provider.
     */
    public function boot(): void
    {
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('tumblr', TumblrProvider::class);
        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
