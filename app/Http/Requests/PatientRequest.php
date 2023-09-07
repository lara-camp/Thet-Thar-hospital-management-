<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|string|unique:users',
            'phone' => 'required|integer',
            'address' => 'required|string|max:100'
        ];

        if ($this->isMethod("PUT") || $this->isMethod("PATCH")) {
            $rules['name'] = 'required|string|min:2|max:100';
            $rules['email'] = ['required', "email", Rule::unique("patients")->ignore($this->patient)];
            $rules['phone'] = "required|integer";
            $rules['address'] = "required|string|max:100";
        }

        return $rules;
    }
}
