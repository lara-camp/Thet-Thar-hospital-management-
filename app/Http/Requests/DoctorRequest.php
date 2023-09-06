<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'phone' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'department' => 'required|string|max:100',
            'experience' => 'required|integer',
            'address' => 'required|string|max:100',
            'bio' => 'nullable|string',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = 'required|string|max:100';
            $rules['phone'] = 'required|string';
            $rules['email'] =  ['required', 'email', Rule::unique('doctors')->ignore($this->doctor)];
            $rules['department'] = 'required|string|max:100';
            $rules['experience'] = 'required|integer';
            $rules['address'] = 'required|string|max:100';
            $rules['bio'] = 'nullable|string';
        }

        return $rules;
    }
}
