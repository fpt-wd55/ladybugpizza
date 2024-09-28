<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInfoRequest extends FormRequest
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
            'fullname' => 'required',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
            'avatar' => 'required|url',
            'address' => 'max:255',
        ];
    }

    public function messages():array {
        return [
            'fullname.required' => 'Họ và tên không được để trống',
            'date_of_birth.required' => 'Ngày sinh không được để trống',
            'date_of_birth.date' => 'Ngày sinh không đúng định dạng',
            'date_of_birth.before' => 'Ngày sinh không được trước ngày hiện tại',
            'gender.required' => 'Giới tính không được để trống',
            'gender.in' => 'Giới tính không hợp lệ',
            'avatar.required' => 'Ảnh đại diện không được để trống',
            'avatar.url' => 'Ảnh đại diện không đúng định dạng',
            'address.max' => 'Địa chỉ không được quá 255 ký tự',
        ];
    }
}
