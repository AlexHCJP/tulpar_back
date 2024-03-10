<?php

namespace App\Http\Requests\Api\v1\Store;

use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (
            auth('store_api')->check()
            && auth('store_api')->id() == $this->id
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'firebase_token' => ['nullable', 'string'],
        ];
    }
}
