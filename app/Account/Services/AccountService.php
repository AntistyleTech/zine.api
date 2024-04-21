<?php

declare(strict_types=1);

namespace App\Account\Services;

use App\Account\Repository\AccountRepository;
use App\Account\Services\Data\AccountData;
use App\Auth\Services\Data\UserData;

final class AccountService
{
    public function __construct(
        private readonly AccountRepository $accountRepository,
    ) {
    }

    public function create(UserData $user): AccountData
    {
        // TODO: check user isAdmin and choose create() or createOrFirst()
        return $this->accountRepository->createOrFirst($user->id, $user->name);
    }
}
