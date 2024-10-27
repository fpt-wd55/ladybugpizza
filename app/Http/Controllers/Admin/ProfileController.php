<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Xác thực ảnh (chỉ khi có ảnh được tải lên)
        // $request->validate(
        //     [
        //         'email' => 'required|email|unique:users,email,' . Auth::id(), // Email phải là duy nhất
        //         'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     ],
        //     [
        //         'email.required' => 'Trường :attribute là bắt buộc.',
        //         'email.email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
        //         'unique' => 'Địa chỉ email đã tồn tại.',
        //         'image' => 'Trường :attribute phải là một hình ảnh.',
        //         'mimes' => 'Trường :attribute phải có định dạng: :values.',
        //         'max' => [
        //             'file' => 'Trường :attribute không được lớn hơn :max kilobytes.',
        //         ],
        //         'attributes' => [
        //             'email' => 'email',
        //             'avatar' => 'ảnh đại diện',
        //             'gender' => 'giới tính',
        //         ],
        //     ]
        // );
        // Lấy user hiện tại
        $user = Auth::user();
        $user->gender = $request->gender;
        if ($user->email !== $request->email) {
            $user->email = $request->email;
        }
        
        // Kiểm tra nếu có ảnh mới được tải lên
        if ($request->hasFile('avatar')) {
            // Xóa ảnh cũ nếu đã có
            if ($user->avatar && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
            // Lưu ảnh mới
            $path = $request->file('avatar')->store('avatars', 'public');
            // Cập nhật đường dẫn ảnh vào DB
            $user->avatar = $path;
        }
        // Lưu thông tin người dùng
        $user->save();
    
        return redirect()->back()->with('success', 'Thông tin tài khoản đã được cập nhật!');
    }
}
