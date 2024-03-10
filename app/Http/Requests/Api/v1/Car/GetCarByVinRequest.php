<?php

namespace App\Http\Requests\Api\v1\Car;

use Illuminate\Foundation\Http\FormRequest;

class GetCarByVinRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'q' => ['required', 'string'],
        ];
    }
}
