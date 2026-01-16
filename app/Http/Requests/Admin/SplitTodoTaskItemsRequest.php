<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SplitTodoTaskItemsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'include_weekends' => ['nullable', 'boolean'],
            'title_prefix' => ['nullable', 'string', 'max:120'],
        ];
    }
}
