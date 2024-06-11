<?php

namespace App\Enum;

use UnitEnum;

trait HasEnumNames
{
    public static function names(): array
    {
        return array_map(fn (UnitEnum $type) => $type->name, static::cases());
    }
}
