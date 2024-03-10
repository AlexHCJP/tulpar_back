<?php

namespace App\Http\Requests\Api\v1\FavoriteSearch;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('store_api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'rowsPerPage' => ['nullable', 'integer'],
            'startRow' => ['nullable', 'integer'],
            'sortBy' => ['nullable', 'string'],
            'descending' => ['nullable', 'boolean'],
        ];
    }
}
