<?php

namespace App\Http\Requests\Api\v1\PartGroup;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'carId' => ['nullable', 'string'],
            'parentId' => ['nullable', 'string'],
            'descending' => ['nullable', 'boolean'],
            'sortBy' => ['nullable', 'string'],
            'rowsPerPage' => ['nullable', 'integer'],
            'startRow' => ['nullable', 'integer'],
        ];
    }
}
