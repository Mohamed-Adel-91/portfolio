<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperiencesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'co_name' => 'required|string|max:255',
            'work_type' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'icon' => 'nullable|string|max:255',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at'
        ];
    }
}
