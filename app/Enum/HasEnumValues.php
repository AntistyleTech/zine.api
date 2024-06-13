<?php

namespace App\Enum;

use UnitEnum;

trait HasEnumValues
{
    public static function values(): array
    {
        return array_map(fn (UnitEnum $type) => $type->value, static::cases());
    }
}
