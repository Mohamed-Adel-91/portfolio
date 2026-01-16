<?php

namespace App\Http\Requests\Admin;

use App\Models\TodoTaskItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTodoTaskItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (! $this->has('todo_task_id') && $this->route('todo_task')) {
            $this->merge([
                'todo_task_id' => $this->route('todo_task')->id,
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'todo_task_id' => ['required', 'integer', 'exists:todo_tasks,id'],
            'title' => ['required', 'string', 'max:220'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', Rule::in(array_keys(TodoTaskItem::statusOptions()))],
            'scheduled_date' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
