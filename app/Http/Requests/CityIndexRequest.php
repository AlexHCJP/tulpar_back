<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filter' => ['nullable', 'string'],
            'rowsPerPage' => ['nullable', 'integer'],
            'startRow' => ['nullable', 'integer'],
            'sortBy' => ['nullable', 'string'],
            'descending' => ['nullable', 'boolean'],
        ];
    }
}
