<?php

namespace Modules\User\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Http\Rules\LoginRule;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string', new LoginRule()],
            'password' => 'required|string|min:5|max:20',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated(null, $default);

        $rule = app(LoginRule::class);

        $email = $rule->email($validated['login']);
        $name = $rule->name($validated['login']);

        return match ($key) {
            null => array_filter([
                ...$validated,
                'email' => $email,
                'name' => $name,
            ]),
            'email' => $email,
            'name' => $name,
            default => $validated[$key] ?? $default,
        };
    }
}
