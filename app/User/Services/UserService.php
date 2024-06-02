<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Common\Services\UserData;
use App\User\Domain\Model\User;
use App\User\Domain\Repositories\UserRepository;
use App\User\Services\Commands\Register;

final readonly class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function get(int $id): User
    {
        return $this->userRepository->findById($id);
    }

    public function register(Register $request): User
    {
        $user = $this->userRepository->create(CreateUser::from($request));

        // TODO: implement confirmation

        return $user;
    }

    public function search(SearchUser $request): ?UserData
    {
        return $this->userRepository->search($request);
    }
}
