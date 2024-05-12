<?php

declare(strict_types=1);

namespace App\Account\Services;

use App\Account\Repositories\AccountRepository;
use App\Account\Services\Data\AccountData;
use App\Auth\Services\Data\UserData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\WithData;

final class Account extends Data
{
    use WithData;

    public function __construct(
        public int $id,
        public string $name,
    ) {
    }

    public function __construct(
        private readonly AccountRepository $accountRepository,
    ) {
    }

    public function create(
        UserData $user,
        AccountRepository $accountRepository
    ): AccountData {
        // TODO: check user isAdmin and choose create() or createOrFirst()
        return $this->accountRepository->createOrFirst($user->id, $user->username);
    }
}
