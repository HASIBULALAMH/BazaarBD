<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' =>['required', 'string', 'email','max:225','unique:users,email'],
            'password' =>['required', 'confirmed', Password::min(8)],
           'phone' => ['nullable', 'string', 'max:20'],
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
            'name.required' => 'নাম লিখুন | Name is required',
            'name.max' => 'নাম সর্বোচ্চ ২৫৫ অক্ষর | Name maximum 255 characters',

            'email.required' => 'ইমেইল লিখুন | Email is required',
            'email.email' => 'সঠিক ইমেইল দিন | Please enter a valid email',
            'email.unique' => 'এই ইমেইল দিয়ে একাউন্ট আছে | This email is already registered',

            'password.required' => 'পাসওয়ার্ড লিখুন | Password is required',
            'password.confirmed' => 'পাসওয়ার্ড মিলছে না | Passwords do not match',
            'password.min' => 'পাসওয়ার্ড কমপক্ষে ৮ অক্ষর | Password minimum 8 characters',

            'phone.max' => 'ফোন নম্বর সর্বোচ্চ ২০ অক্ষর | Phone maximum 20 characters',
        ];
    }



}
