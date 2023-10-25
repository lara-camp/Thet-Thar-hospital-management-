<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'role' => 'required|string|max:100',
            'is_visible' => 'required|boolean',
            'email_verified_at' => 'nullable|date',
            'password' => 'required|string|min:8|Password::min(8)->letters()',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = 'nullable|string|max:100';
            $rules['email'] = 'nullable|email|unique:users,email,' . $this->id ?? $this->user->id;
            $rules['password'] = 'nullable|string|min:8|Password::min(8)->letters()';
            $rules['phone'] = 'nullable|string|max:100';
            $rules['address'] = 'nullable|string|max:100';
            $rules['role'] = 'nullable|string|max:100';
            $rules['is_visible'] = 'nullable|boolean';
            $rules['email_verified_at'] = 'nullable|date';
        }

        return $rules;
    }
}
