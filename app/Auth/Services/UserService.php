<?php

declare(strict_types=1);

namespace App\Auth\Services;

use App\Auth\Repositories\Data\CreateUser;
use App\Auth\Repositories\Data\SearchUser;
use App\Auth\Repositories\UserRepository;
use App\Auth\Services\Data\Register;
use App\Auth\Services\Data\UserData;

final readonly class UserService
{
    public function __construct(
        private UserRepository $repository
    ) {
    }

    public function get(int $id): UserData
    {
        return $this->repository->find($id);
    }

    public function register(Register $request): UserData
    {
        $user = $this->repository->create(CreateUser::from($request));

        // TODO: implement confirmation
        return $user;
    }

    public function search(SearchUser $request): UserData
    {
        return $this->repository->search($request);
    }
}
