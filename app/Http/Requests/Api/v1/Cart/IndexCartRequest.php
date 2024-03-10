<?php

namespace App\Http\Requests\Api\v1\Cart;

use Illuminate\Foundation\Http\FormRequest;

class IndexCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('api')->check();
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth('api')->id(),
        ]);
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'rowsPerPage' => ['nullable', 'integer'],
            'startRow' => ['nullable', 'integer'],
            'sortBy' => ['nullable', 'string'],
            'descending' => ['nullable', 'boolean'],
        ];
    }
}
