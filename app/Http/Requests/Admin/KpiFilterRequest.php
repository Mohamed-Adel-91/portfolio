<?php

namespace App\Http\Requests\Admin;

use App\Models\TodoTask;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KpiFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date_start' => ['nullable', 'date'],
            'date_end' => ['nullable', 'date', 'after_or_equal:date_start'],
            'category_id' => ['nullable', 'integer', 'exists:todo_categories,id'],
            'quadrant' => ['nullable', 'string', Rule::in(array_keys(TodoTask::quadrantOptions()))],
            'stars_min' => ['nullable', 'integer', 'min:1', 'max:5'],
            'status' => ['nullable', 'string', Rule::in(array_keys(TodoTask::statusOptions()))],
            'include_items' => ['nullable', 'boolean'],
            'include_tasks' => ['nullable', 'boolean'],
        ];
    }
}
