<?php

declare(strict_types=1);

namespace App\Account\Repository;

use App\Account\Models\Account;
use App\Account\Services\Data\AccountData;

final class AccountRepository
{
    public function createOrFirst(int $userId, string $name): AccountData
    {
        $account = Account::createOrFirst(['user_id' => $userId, 'name' => $name]);
        return AccountData::from($account);
    }
}
