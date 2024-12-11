<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InactiveRequest extends FormRequest
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
            'confirm_email' =>  'required|string|max:255',
        ];
    }


    public function messages(): array
    {
        return [
            'confirm_email.required' => 'Vui lòng nhập email của bạn',
            'confirm_email.string' => 'Email không hợp lệ',
            'confirm_email.max' => 'Email không được vượt quá 255 ký tự',
        ];
    }


    
}
