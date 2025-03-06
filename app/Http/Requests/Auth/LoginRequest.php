<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|email|email:rfc,dns|max:100|email:rfc,dns',
            'password' => 'required|string|min:8',
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
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Your email address cannot be longer than 100 characters.',
            'password.required' => 'Please enter your password.',
            'password.min' => 'Your password must be at least 8 characters long.',
        ];
    }


}
