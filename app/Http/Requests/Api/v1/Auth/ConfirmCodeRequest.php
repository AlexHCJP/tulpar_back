<?php

namespace App\Http\Requests\Api\v1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmCodeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'starts_with:+'],
            'code' => ['required', 'integer'],
        ];
    }
}
