<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'address' => 'required|max:255',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'title' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'province.required' => 'Tỉnh/Thành phố không được để trống',
            'district.required' => 'Quận/Huyện không được để trống',
            'ward.required' => 'Phường/Xã không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'address.max' => 'Địa chỉ không được quá 255 ký tự',
            'title.required' => 'Loại địa chỉ không được để trống',
            'title.max' => 'Loại địa chỉ không được quá 255 ký tự',
        ];
    }
}
