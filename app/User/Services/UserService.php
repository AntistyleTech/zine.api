<?php

declare(strict_types=1);

namespace App\Auth\Services;

use App\Account\Services\AccountService;
use App\Auth\Repositories\Data\CreateUser;
use App\Auth\Repositories\Data\SearchUser;
use App\Auth\Repositories\UserRepository;
use App\Auth\Services\Data\Register;
use App\Common\Services\UserData;

final readonly class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private AccountService $accountService
    ) {
    }

    public function get(int $id): UserData
    {
        return $this->userRepository->find($id);
    }

    public function register(Register $request): UserData
    {
        $user = $this->userRepository->create(CreateUser::from($request));
        $this->accountService->create($user);

        // TODO: implement confirmation

        return $user;
    }

    public function search(SearchUser $request): ?UserData
    {
        return $this->userRepository->search($request);
    }
}
