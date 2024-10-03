<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return $this->rulesForCreate();
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            return $this->rulesForUpdate();
        }

        return [];
    }

    private function rulesForCreate()
    {
        return [
            'username' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:7|max:11|unique:users,phone',
            'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/',
            'avatar' => 'required|mimes:jpeg,png,jpg,gif,bmp,svg,webp|max:2048',
            'date_of_birth' => 'required|date|before:today',
            'roleSelect' => 'required|integer',
            'permissionSelect' => 'nullable|integer', 
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'detail_address' => 'required|string|max:255',
            'gender' => 'required',
        ];
    }

    private function rulesForUpdate()
    {
        return [
            'username' => 'sometimes|required|string|max:255',
            'fullname' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email',
            'phone' => 'sometimes|required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date_of_birth' => 'sometimes|required|date',
            'roleSelect' => 'sometimes|required|integer',
            'permissionSelect' => 'nullable|integer',
            'password' => 'sometimes|required|string|min:8', 
            'province' => 'sometimes|required|integer',
            'district' => 'sometimes|required|integer',
            'ward' => 'sometimes|required|integer',
            'detail_address' => 'sometimes|required|string|max:255',
        ];
    }

    public function withValidator($validator)
    {
        $validator->sometimes('permissionSelect', 'required|integer', function ($input) {
            return $input->roleSelect == 1;
        });
    }

    public function messages()
    {
        return [
            'username.required' => 'Tên người dùng là bắt buộc.',
            'username.max' => 'Tên người dùng quá dài.',
            'fullname.required' => 'Họ và tên là bắt buộc.',
            'fullname.max' => 'Họ và tên không hợp lệ.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.min' => 'Số điện thoại phải có ít nhất 7 ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 11 ký tự.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ hoa, một chữ số và một ký tự đặc biệt.',
            'avatar.required' => 'Ảnh đại diện là bắt buộc.',
            'avatar.mimes' => 'Ảnh đại diện phải là một trong các định dạng: jpeg, png, jpg, gif, bmp, svg, webp.',
            'avatar.max' => 'Ảnh đại diện không được vượt quá 2048 KB.',
            'date_of_birth.required' => 'Ngày sinh là bắt buộc.',
            'date_of_birth.date' => 'Ngày sinh không hợp lệ.',
            'date_of_birth.before' => 'Ngày sinh không hợp lệ.',
            'roleSelect.required' => 'Vui lòng chọn vai trò.',
            'permissionSelect.integer' => 'Vui lòng chọn quyền hạn.',
            'province.required' => 'Tỉnh/Thành là bắt buộc.',
            'district.required' => 'Huyện/Tỉnh là bắt buộc.',
            'ward.required' => 'Phường/Xã là bắt buộc.',
            'detail_address.required' => 'Địa chỉ chi tiết là bắt buộc.',
            'detail_address.max' => 'Địa chỉ chi tiết quá dài.',
            'gender.required' => 'Vui lòng chọn giới tính.',
            'permissionSelect.required' => 'Vui lòng chọn quyền hạn.',
        ];
    }
}
