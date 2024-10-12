<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRequest extends FormRequest
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
            'current_password' => ['required', 'min:8'],
			'new_password' => ['required', 'min:8', 'confirmed'],
        ];
    }
    public function messages():array {
        return[
            'current_password.required' => 'Vui lòng nhập mật khẩu.',
			'current_password.min' => 'Mật khẩu cũ phải có ít nhất 8 ký tự.',
			'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
			'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
			'new_password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        ];
    }
}
