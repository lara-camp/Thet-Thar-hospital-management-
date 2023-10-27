<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'patient_id' => 'required|integer|exists:users,id',
            'doctor_id' => 'required|integer|exists:doctors,id',
            'appointment_date' => 'required|date',
            'description' => 'nullable|string',
            'status' => 'nullable|in:completed,pending,rejected',
            'type' => 'nullable|in:online,offline',
            'is_visible' => 'nullable|boolean',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['patient_id'] = 'required|integer|exists:users,id';
            $rules['doctor_id'] = 'required|integer|exists:doctors,id';
            $rules['appointment_date'] = 'required|date';
            $rules['description'] = 'nullable|string';
            $rules['status'] = 'nullable|in:completed,pending,rejected';
            $rules['type'] = 'nullable|in:online,offline';
            $rules['is_visible'] = 'boolean';
        }

        return $rules;
    }
}
