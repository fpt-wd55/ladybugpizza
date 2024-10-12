<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'password' => 'required|string|min:8',
        ];
    }

    public function messages():array {
        return[
            'password.required' => 'Vui lòng nhập mật khẩu.',
			'password.min' => 'Mật khẩu cũ phải có ít nhất 8 ký tự.',
        ];
    }

    
}
