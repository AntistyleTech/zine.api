<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use League\OAuth2\Client\Token\AccessToken;
use Modules\Social\Services\Tumblr\TumblrService;

class TumblrController extends Controller
{
    public function __construct(
        private TumblrService $tumblrService
    ) {
    }

    public function auth(): RedirectResponse
    {
        return Socialite::driver('tumblr')->redirect();
    }

    public function authConfirmed(Request $request)
    {
        $tumblrUser = Socialite::driver('tumblr')
            ->user();

        $appUser = Auth::user();

        dd($tumblrUser, $appUser);

        return response('', 201);
    }

    public function user(): JsonResponse
    {
        // TODO: get token by User
        $tokenData = '{"token_type":"bearer","scope":"basic","id_token":false,"access_token":"aioREE6tV9a85peMtvxdy7TJi4IdtbBpnkXFabiyvubGcnjfiD","expires":1718008318}';
        $tokenData = json_decode($tokenData, true);

        $token = new AccessToken($tokenData);
        $this->tumblrService->user();
        $resourceOwner = $this->provider->getResourceOwner($token);

        return response()->json($resourceOwner->toArray());
    }

    public function sendPost(Request $request)
    {
        $this->tumblrService->posts();
    }
}
