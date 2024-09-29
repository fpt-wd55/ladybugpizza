<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtpRequest extends FormRequest
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
            'otp' => 'required|digits:6'
        ];
    }

    public function messages(): array {
        return [
            'otp.required' => 'Không được để trống mã OTP',
            'otp.digits' => 'Mã OTP phải có đúng 6 số',
        ];
    }
}