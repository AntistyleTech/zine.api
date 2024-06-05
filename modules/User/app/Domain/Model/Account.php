<?php

declare(strict_types=1);

namespace App\User\Domain\Model;

use App\Common\Domain\Entity;

final class Account extends Entity
{
    public function __construct(
        public int $id,
        public string $name
    ) {
    }
}
