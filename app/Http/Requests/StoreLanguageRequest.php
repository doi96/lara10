<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLanguageRequest extends FormRequest
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
            'name' => 'required',
            'canonical' => 'required|unique:languages'
            // 'image' => 'required'
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'Language Name is required, please enter a language name!',
            'canonical.required' => 'Canonical field is required. Please enter a valid canonical!',
            'canonical.unique' => 'Canonical is exists, please enter another canonical!',
        ];
    }
}
