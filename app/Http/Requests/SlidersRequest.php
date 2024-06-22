<?php
namespace App\Http\Requests;

use App\Models\Sliders;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class SlidersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'pageName' => 'required|string|max:255',
            'sectionName' => 'required|string|max:255',
            'pageName.*' => 'required|string|max:255',
            'sectionName.*' => 'required|string|max:255',
            'slider_no' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    $sliderId = $this->route('slider');
                    $showStatus = $this->input('show_status');
                    $pageName = $this->input('pageName');
                    $sectionName = $this->input('sectionName');

                    Log::debug('Validating slider_no', [
                        'value' => $value,
                        'attribute' => $attribute,
                        'sliderId' => $this->route('slider'),
                        'showStatus' => $showStatus,
                        'pageName' => $pageName,
                        'sectionName' => $sectionName,
                    ]);

                    // Check if show status is 'Active' (case-insensitive)
                    if (strtolower($this->input('show_status')) === 'active') {
                        // Get the current slider's ID
                        $sliderId = $this->route('slider');
                        // If $sliderId is an object, get its ID
                        if ($sliderId) {
                            $sliderId = $sliderId->id;
                        }

                        // Check if another record with the same slider_no and Active show status exists in the same pageName or sectionName
                        $exists = Sliders::where('slider_no', $value)
                            ->where('show_status', 'active')
                            ->where(function ($query) use ($sectionName) {
                                $query->Where('sectionName', $sectionName);
                            })
                            ->where('id', '!=', $sliderId) // Exclude the current slider
                            ->exists();

                        // Fail validation if the uniqueness check fails
                        if ($exists) {
                            $fail('The slider number is already taken for the specified page or section when the show status is Active.');
                        }
                    }
                },
            ],
            'show_status' => 'required|in:Active,active,Inactive,inactive',
            'image' => $this->isMethod('POST') ? 'required|image|mimes:jpeg,jpg,png,gif,webp,svg|max:5000' : 'nullable|image|mimes:jpeg,jpg,png,gif,webp,svg|max:5000',
            'title' => 'nullable|array',
            'title.en' => 'nullable|string|max:255',
            'title.ar' => 'nullable|string|max:255',
            'title.fr' => 'nullable|string|max:255',
            'description' => 'nullable|array',
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',
            'description.fr' => 'nullable|string',
            'btn_url' => 'nullable|url',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'pageName.required' => 'Page name is required',
            'sectionName.required' => 'Section name is required',
            'slider_no.required' => 'Slider number is required',
            'show_status.required' => 'Show status is required',
        ];
    }
}