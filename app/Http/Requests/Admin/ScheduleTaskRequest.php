<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'todo_task_id' => ['required', 'integer', 'exists:todo_tasks,id'],
            'scheduled_date' => ['required', 'date'],
        ];
    }
}
