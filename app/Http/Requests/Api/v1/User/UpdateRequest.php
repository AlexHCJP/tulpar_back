<?php

namespace App\Http\Requests\Api\v1\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('api')->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'unique:users,email,' . auth('api')->id()],
            'phone' => ['nullable', 'starts_with:+', 'unique:users,phone,' . auth('api')->id()],
            'password' => ['nullable', 'min:8', 'max:32'],
            'image' => ['nullable', 'image'],
            'firebase_token' => ['nullable', 'string'],
        ];
    }
}
