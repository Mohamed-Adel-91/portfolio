<?php

namespace App\Http\Requests\Admin;

use App\Models\TodoCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTodoCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var TodoCategory $category */
        $category = $this->route('todo_category');

        return [
            'name' => ['required', 'string', 'max:120'],
            'slug' => [
                'nullable',
                'string',
                'max:140',
                Rule::unique('todo_categories', 'slug')->ignore($category?->id),
            ],
            'color' => ['nullable', 'regex:/^#([0-9a-fA-F]{6})$/'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
