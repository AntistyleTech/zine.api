<?php

declare(strict_types=1);

namespace Modules\Social\Services\Tumblr\Oauth2;

use SocialiteProviders\Manager\SocialiteWasCalled;

final class TumblrExtendSocialite
{
    public function handle(SocialiteWasCalled $socialiteWasCalled): void
    {
        $socialiteWasCalled->extendSocialite('tumblr', TumblrProvider::class);
    }
}
