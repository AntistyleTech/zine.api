<?php

declare(strict_types=1);

namespace Modules\User\Domain\Repositories;

use Modules\User\Domain\Model\User;

interface UserRepository
{
    public function findById(int $id): ?User;
    public function search(SearchUser $search): ?User;
    public function create(CreateUser $create): ?User;
    public function update(UpdateUser $update): User;
}
