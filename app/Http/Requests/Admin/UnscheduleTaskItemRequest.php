<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UnscheduleTaskItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (! $this->has('todo_task_item_id') && $this->route('item')) {
            $this->merge([
                'todo_task_item_id' => $this->route('item')->id,
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'todo_task_item_id' => ['required', 'integer', 'exists:todo_task_items,id'],
        ];
    }
}
