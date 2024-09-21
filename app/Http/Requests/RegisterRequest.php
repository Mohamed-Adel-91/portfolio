<?php

namespace App\Http\Requests;

use App\Rules\RealEmailRule;
use App\Rules\StrongPasswordRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s-]*$/'],
            'email' => ['required', 'email', 'unique:users,email', new RealEmailRule],
            'phone' => 'required|regex:/^\+?[0-9\s]+$/|unique:users,phone',
            'speciality_id' => 'required|exists:specialities,id',
            'password' => ['required', 'string', new StrongPasswordRule, 'confirmed'],
            'whatsapp' => 'nullable|string|regex:/^\+?[0-9\s]+$/|unique:users,whatsapp',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validationErrorResponse($validator->errors()));
    }
}
