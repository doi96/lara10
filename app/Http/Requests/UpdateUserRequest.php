<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users,email,'.$this->id.'|max:191',
            'name' => 'string|required',
            'user_catalogue_id' => 'required|integer|gt:0',
        ];
    }

    public function messages(): array {
        return [
            'email.required' => 'Email is required. Please enter a valid email address!',
            'email.unique' => 'Email already exists in the system. Please choose another email!',
            'email.max' => 'The number of characters is too limited, the maximum is 191 characters!',
            'email.email' => 'Email format is incorrect. Please enter a valid email address!',
            'name.required' => 'Full Name field is required. Please enter a valid name!',
        ];
    }
}
