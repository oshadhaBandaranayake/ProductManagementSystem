<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|email:rfc,dns|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ];
    }

      /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please enter your name.',
            'name.string' => 'Your name can only contain letters.',
            'name.max' => 'Your name cannot be longer than 100 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Your email cannot be longer than 100 characters.',
            'email.unique' => 'This email is already registered. Please use a different email.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'Your password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password_confirmation.required' => 'Please confirm your password.',
            'password_confirmation.min' => 'The confirmation password must be at least 8 characters long.',
        ];
    }
}
