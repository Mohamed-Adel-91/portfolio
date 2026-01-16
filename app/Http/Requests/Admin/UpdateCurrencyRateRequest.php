<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCurrencyRateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rates' => ['required', 'array'],
            'rates.USD.rate_to_egp' => ['required', 'numeric', 'min:0.000001'],
            'rates.SAR.rate_to_egp' => ['required', 'numeric', 'min:0.000001'],
            'rates.*.is_active' => ['nullable', 'boolean'],
        ];
    }
}
