<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
        return [
            'email'=>'required|email',
            'password'=>'required|string',
            'token_name'=>'required',
        ];
    }

    public function messages(): array {
        return [
            'email.required' => 'you need to input an email',  
            'email.email' => 'you need to input a valid email', 
            'password.required' => 'You need to input a password',
        ];
    }

    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(response()->json($validator->errors(), 422)); 
    }
}
