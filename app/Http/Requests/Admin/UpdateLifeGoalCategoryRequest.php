<?php

namespace App\Http\Requests\Admin;

use App\Models\LifeGoalCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLifeGoalCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var LifeGoalCategory|null $category */
        $category = $this->route('life_goal_category');

        return [
            'name' => ['required', 'string', 'max:120'],
            'slug' => [
                'nullable',
                'string',
                'max:140',
                Rule::unique('life_goal_categories', 'slug')->ignore($category?->id),
            ],
            'description' => ['nullable', 'string'],
            'color' => ['nullable', 'regex:/^#([0-9a-fA-F]{6})$/'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
