<?php

namespace App\Http\Requests\Admin;

use App\Models\TodoTask;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTodoTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:180'],
            'description' => ['nullable', 'string'],
            'todo_category_id' => ['nullable', 'integer', 'exists:todo_categories,id'],
            'status' => ['nullable', 'string', Rule::in(array_keys(TodoTask::statusOptions()))],
            'quadrant' => ['nullable', 'string', Rule::in(array_keys(TodoTask::quadrantOptions()))],
            'stars' => ['nullable', 'integer', 'min:1', 'max:5'],
            'due_date' => ['nullable', 'date'],
            'scheduled_date' => ['nullable', 'date'],
            'start_date' => ['nullable', 'date', 'required_with:end_date'],
            'end_date' => ['nullable', 'date', 'required_with:start_date', 'after_or_equal:start_date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
