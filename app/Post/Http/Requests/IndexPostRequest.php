<?php

namespace App\Post\Http\Requests;

use App\Content\Services\Data\enum\ContentType;
use App\Content\Services\Data\enum\Lang;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['sometimes|array'],
            'category' => ['sometimes|array'],
            'type' => ['sometimes', Rule::enum(ContentType::class)], // always Post
            'lang' => ['sometimes', Rule::enum(Lang::class)]
        ];
    }
}
