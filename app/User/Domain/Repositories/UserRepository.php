<?php

declare(strict_types=1);

namespace App\User\Domain\Repositories;

use App\Auth\Repositories\Data\CreateUser;
use App\Auth\Repositories\Data\SearchUser;
use App\User\Domain\Model\User;

interface UserRepository
{
    public function findById(int $id): ?User;

    public function search(SearchUser $search): ?User;

    public function create(CreateUser $create): ?User;
}
