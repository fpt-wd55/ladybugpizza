<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admins.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.user.add');
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
            $validatedData['status'] = 0;
        }

        // Xu ly hinh anh
        $avatar = $request->file('avatar');
        $avatar_name = time() . '_' . pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $avatar->getClientOriginalExtension();
        $validatedData['avatar'] = $avatar_name;

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

            return redirect()->route('admin.users.index')->with('success', 'Thêm mới người dùng thành công');
        } else {
            return redirect()->route('admin.users.index')->with('error', 'Thêm mới người dùng thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $addresses = $user->addresses;
        $orders = $user->orders;
        $evaluations = $user->evaluations;
        $favorites = null;

        return view('admins.user.detail', compact('user', 'addresses', 'orders', 'evaluations', 'favorites'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $addresses = $user->addresses;
        return view('admins.user.edit', compact('user', 'addresses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user) {}
}
