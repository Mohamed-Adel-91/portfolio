<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_tags' => 'nullable|string',
            'cards' => 'nullable|integer',
            'transactions' => 'nullable|integer',
            'countries' => 'nullable|integer',
            'decades' => 'nullable|integer',
            'customers' => 'nullable|integer',
        ];
    }
}
