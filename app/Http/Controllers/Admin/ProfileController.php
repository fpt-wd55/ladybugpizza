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
        $user->save();

        return redirect()->back()->with('success', 'Thông tin tài khoản đã được cập nhật!');
    }
}
