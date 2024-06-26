<?php

declare(strict_types=1);

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

final class GithubController extends Controller
{
    public function auth(Request $request): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    public function authConfirmed(Request $request)
    {
//        $auth = Auth::user();
        $session = $request->session();
        $user = Socialite::driver('github')->user();

        dd([$session, $user->getId(), $user->getEmail()]);
    }
}
