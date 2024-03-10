<?php

namespace App\Http\Requests\Api\v1\Part;

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
            'group_id' => ['nullable', 'string'],
            'name' => ['nullable', 'string'],
            'descending' => ['nullable', 'boolean'],
            'sortBy' => ['nullable', 'string'],
            'rowsPerPage' => ['nullable', 'integer'],
            'startRow' => ['nullable', 'integer'],
        ];
    }
}
