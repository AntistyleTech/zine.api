<?php

declare(strict_types=1);

namespace Modules\User\Services;

use App\Contracts\Auth\UserData;
use Modules\User\Domain\Repositories\UserRepository;
use Modules\User\Domain\Model\User;
use Modules\User\Services\Commands\Register;

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
