<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'fullname' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,11',
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ];
    }

    public function messages():array {
        return[
            'fullname.required' => 'Họ và tên không được để trống',
            'fullname.string' => 'Họ và tên phải là chuỗi ký tự',
            'fullname.max' => 'Họ và tên không được vượt quá 255 ký tự',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.digits_between' => 'Số điện thoại không hợp lệ',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không được vượt quá 255 ký tự',
            'title.required' => 'Tiêu đề không được để trống',
            'title.string' => 'Tiêu đề phải là chuỗi ký tự',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'message.required' => 'Nội dung không được để trống',
            'message.string' => 'Nội dung phải là chuỗi ký tự',
            'message.max' => 'Nội dung không được vượt quá 1000 ký tự',
        ];
    }
}
