<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admins.profile.index', compact('user'));
    }
    public function update(Request $request)
    {
        // Lấy user hiện tại
        $user = Auth::user();
		$user->gender = $request->input('gender');
        if ($user->email !== $request->email) {
            $user->email = $request->email;
        }
        // Kiểm tra nếu có ảnh mới được tải lên
        if ($request->hasFile('avatar')) {
            // Xóa ảnh cũ nếu đã có
            if ($user->avatar && Storage::exists('uploads/avatars/' . $user->avatar)) {
                Storage::delete('uploads/avatars/' . $user->avatar);
            }
            // Lưu ảnh mới vào thư mục 'uploads/avatars'
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName(); // Lấy tên gốc của file
            // Đảm bảo tên ảnh không trùng bằng cách thêm timestamp nếu cần
            $uniqueFilename = time() . '_' . $filename;
            // Lưu file vào storage
            $file->storeAs('uploads/avatars', $uniqueFilename, 'public');
            // Cập nhật tên ảnh vào cột 'avatar' trong database
            $user->avatar = $uniqueFilename;
        }
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required',
            'confirm_password' => isset($request->new_password) ? 'required|same:new_password' : 'same:new_password',
            'new_password' => [
                'min:8', 
                'nullable', 
                'regex:/[A-Z]/',  // Ít nhất một chữ hoa
                'regex:/[0-9]/',  // Ít nhất một số
                'regex:/[\W_]/',  // Ít nhất một ký tự đặc biệt
            ],
        ], [
            'email.required' => 'Email không được bỏ trống',
            'new_password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'new_password.regex' => 'Mật khẩu phải chứa ít nhất một chữ hoa, một số và một ký tự đặc biệt',
            'confirm_password.same' => 'Mật khẩu xác nhận không khớp',
            'confirm_password.required' => 'Xác nhận mật khẩu không được bỏ trống',
        ]);
        if($request->new_password){
            $user->password = Hash::make($request->new_password);
        }
        $user->save();
        return redirect()->back()->with('success', 'Thông tin tài khoản đã được cập nhật!');
    }
}
