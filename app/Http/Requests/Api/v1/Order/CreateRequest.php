<?php

namespace App\Http\Requests\Api\v1\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'car_id' => ['required', 'exists:cars,api_id'],
            'part_id' => ['required', 'exists:parts,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'comment' => ['nullable', 'string', 'max:255'],
            'payment_type' => ['required', 'in:cash,card,epayment'],
            'lat' => ['nullable', 'numeric'],
            'lon' => ['nullable', 'numeric'],
            'photos' => ['nullable', 'array'],
            'photos.*' => ['nullable', 'image'],
        ];
    }
}
