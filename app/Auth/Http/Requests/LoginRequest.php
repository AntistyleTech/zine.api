<?php

namespace App\Auth\Http\Requests;

use App\Auth\Http\Rules\LoginRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    private LoginRule $loginRule;

    public function __construct(
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    ) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->loginRule = new LoginRule;
    }

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string', $this->loginRule],
            'password' => 'required|string|min:5|max:20',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated(null, $default);

        $email = $this->loginRule->email($validated['login']);
        $username = $this->loginRule->username($validated['login']);

        return match ($key) {
            null => array_filter([
                ...$validated,
                'email' => $email,
                'username' => $username,
            ]),
            'email' => $email,
            'username' => $username,
            default => $validated[$key] ?? $default,
        };
    }
}
