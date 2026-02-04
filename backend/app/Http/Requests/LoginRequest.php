<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

        /**
        * Get custom bilingual error messages (Bangla | English).
        *
        * @return array<string, string>
        */
        public function messages(): array
        {
            return [
                'email.required' => 'ইমেইল লিখুন | Email is required',
                'email.email' => 'সঠিক ইমেইল দিন | Please enter a valid email',
                'password.required' => 'পাসওয়ার্ড লিখুন | Password is required',
            ];
        }
}
