<?php

namespace App\Http\Requests\Api\v1\Store;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('store_api')->check();
    }

    public function rules(): array
    {
        return [
            'producers' => ['nullable', 'array'],
            'models' => ['nullable', 'array'],
            'parts' => ['nullable', 'array'],
        ];
    }
}
