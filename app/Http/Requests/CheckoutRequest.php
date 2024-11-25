<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'detail_address' => 'required|string',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'notes' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Nhập họ và tên của bạn',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'phone.required' => 'Số điện thoại không được để trống',
            'detail_address.required' => 'Địa chỉ không được để trống',
            'province.required' => 'Vui lòng chọn Tỉnh/Thành phố',
            'district.required' => 'Vui lòng chọn Quận/Huyện',
            'ward.required' => 'Vui lòng chọn Phường/Xã',
            'payment_method_id.required' => 'Vui lòng chọn phương thức thanh toán',
            'payment_method_id.exists' => 'Phương thức thanh toán không khả dụng',
            'notes.string' => 'Ghi chú không hợp lệ',
        ];
    }
}
