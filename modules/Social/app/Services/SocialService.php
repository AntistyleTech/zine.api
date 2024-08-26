<?php

namespace Modules\Social\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Contracts\User;
use Modules\Social\Enum\SocialNetwork;
use Modules\Social\Models\SocialAccount;
use Modules\User\Models\Account;

final class SocialService
{
    /**
     * @param int $accountId
     * @return Collection<SocialAccount>
     */
    public function getAccounts(int $accountId): Collection
    {
        return SocialAccount::where('account_id', $accountId)->get();
    }

    public function getAvailable(): array
    {
        $available = [
            SocialNetwork::Tumblr,
            SocialNetwork::Twitter,
            SocialNetwork::Telegram,
        ];

        return array_map(fn ($socialNetwork) => [
            'socialNetwork' => $socialNetwork->value,
            'authUrl' => env('APP_URL') . "/api/social/auth/$socialNetwork->value",
        ], $available);
    }

    public function createAccount(
        int $accountId,
        SocialNetwork $network,
        string $token,
        ?array $data = null
    ): SocialAccount {
        // TODO: check account already registered
        return SocialAccount::create([
            'account_id' => $accountId,
            'social_network' => $network->value,
            'token' => $token,
            'data' => json_encode($data ?? [])
        ]);
    }
}
