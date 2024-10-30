<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10); 
        $roles = Role::where('id', '>', 1)->get();
        return view('admins.user.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Role::where('id', '>', 2)->get();
        return view('admins.user.add', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();

        // Kiem tra role_id
        if ($validatedData['roleSelect'] == 1) {
            $role_id = $validatedData['permissionSelect'];
        } else {
            $role_id = $validatedData['roleSelect'];
        }
        // Kiem tra trang thai (Status)
        if (!isset($validatedData['status'])) {
            $validatedData['status'] = 2;
        }

        // Xu ly hinh anh
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatar_name = time() . '_' . pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $avatar->getClientOriginalExtension();
            $validatedData['avatar'] = $avatar_name;
        }
        $data = [
            'username' => trim($validatedData['username']),
            'fullname' => trim($validatedData['fullname']),
            'email' => trim($validatedData['email']),
            'phone' => trim($validatedData['phone']),
            'password' => bcrypt(trim($validatedData['password'])),
            'google_id' => null,
            'role_id' => $role_id,
            'avatar' => $validatedData['avatar'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'gender' => $validatedData['gender'],
            'status' => $validatedData['status'],
        ];

        if (User::create($data)) {
            // Xu ly upload anh
            $avatar->storeAs('public/uploads/avatars', $avatar_name);

            return redirect()->route('admin.users.index')->with('success', 'Thêm mới tài khoản thành công');
        } else {
            return redirect()->route('admin.users.index')->with('error', 'Thêm mới tài khoản thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $addresses = $user->addresses;
        $orders = $user->orders()->paginate(5);
        $evaluations = $user->evaluations;
        $favorites = null;

        return view('admins.user.detail', compact('user', 'addresses', 'orders', 'evaluations', 'favorites'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $permissions = Role::where('id', '>', 2)->get();
        return view('admins.user.edit', compact('user', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $validatedData = $request->validated();

        // Kiem tra role_id
        if ($validatedData['roleSelect'] == 1) {
            $role_id = $validatedData['permissionSelect'];
        } else {
            $role_id = $validatedData['roleSelect'];
        }
        // Kiem tra trang thai (Status)
        if (!isset($validatedData['status'])) {
            $validatedData['status'] = 2;
        }

        // Kiem tra khong huy duoc tai khoan quan tri
        if ($user->role_id != 2 && $user->status == 1 && $validatedData['status'] == 2) {
            return redirect()->route('admin.users.edit', $user->id)->with('error', 'Không thể khóa tài khoản quản trị');
        }

        // Xu ly hinh anh
        $validatedData['avatar'] = $user->avatar;
        $old_avatar = $user->avatar;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatar_name = time() . '_' . pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $avatar->getClientOriginalExtension();
            $validatedData['avatar'] = $avatar_name;
        }

        // Kiem tra nhap mat khau moi
        if (isset($validatedData['new_password'])) {
            $validatedData['new_password'] = bcrypt($validatedData['new_password']);
        }

        $data = [
            'username' => $user->username,
            'fullname' => trim($validatedData['fullname']),
            'email' => trim($validatedData['email']),
            'phone' => trim($validatedData['phone']),
            'password' => $validatedData['new_password'] ? bcrypt(trim($validatedData['new_password'])) : $user->password,
            'google_id' => null,
            'role_id' => $role_id,
            'avatar' => $validatedData['avatar'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'gender' => $validatedData['gender'],
            'status' => $validatedData['status'],
        ];

        if ($user->update($data)) {
            // Xu ly upload anh va xoa anh cu
            if ($request->hasFile('avatar')) {
                $avatar->storeAs('public/uploads/avatars', $avatar_name);
                // if has file old avatar and old avatar is not default
                if ($old_avatar != 'user-default.png' && $old_avatar != null) {
                    try {
                        unlink(storage_path('app/public/uploads/avatars/' . $old_avatar));
                    } catch (\Throwable $th) {
                        return redirect()->route('admin.users.edit', $user->id)->with('success', 'Cập nhật tài khoản thành công');
                    }
                }
            }

            return redirect()->route('admin.users.edit', $user->id)->with('success', 'Cập nhật tài khoản thành công');
        } else {
            return redirect()->route('admin.users.edit', $user->id)->with('error', 'Cập nhật tài khoản thất bại');
        }
    }

    public function export()
    {
        $this->exportExcel(User::all(), 'danhsachtaikhoan');
    }

    public function search(Request $request)
    {
        $users = User::where('username', 'like', '%' . $request->search . '%')
            ->orWhere('fullname', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%')
            ->orWhere('phone', 'like', '%' . $request->search . '%')
            ->paginate(10);
        $users->appends(['search' => $request->search]);
        return view('admins.user.index', compact('users'));
    }
}
