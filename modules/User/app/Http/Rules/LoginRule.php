<?php

namespace Modules\User\Http\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class LoginRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->email($value) && ! $this->username($value)) {
            $fail("InvalidLoginValue: {$attribute}: {$value}");
        }
    }

    public function email(string $value): ?string
    {
        $isEmail = Validator::make(['email' => $value], ['email' => 'email'])->valid();

        return $isEmail ? $value : null;
    }

    public function username(string $value): ?string
    {
        if ($this->email($value)) {
            return null;
        }

        // TODO: add username check by RegExp
        $isUsername = Validator::make(['username' => $value], ['username' => 'string|min:4|max:25'])->valid();

        return $isUsername ? $value : null;
    }
}
