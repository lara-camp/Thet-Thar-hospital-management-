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
            'user_id' => 'required|integer',
            'hospital_id' => 'required|integer',
            'department_id' => 'required|string|max:100',
            'experience' => 'required|integer',
            'bio' => 'nullable|string',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['user_id'] = 'nullable|integer';
            $rules['hospital_id'] = 'nullable|integer';
            $rules['department_id'] = 'nullable|string|max:100';
            $rules['experience'] = 'nullable|integer';
            $rules['address'] = 'nullable|string|max:100';
        }

        return $rules;
    }
}
