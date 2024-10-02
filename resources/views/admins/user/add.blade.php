@extends('layouts.admin')
@section('content')
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Thêm người dùng</h3>
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Tên tài khoản</label>
                        <input type="text" name="username" id="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('username')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900 ">Họ và tên</label>
                        <input type="text" name="fullname" id="fullname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('fullname')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Số điện thoại</label>
                        <input type="text" name="phone" id="phone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('phone')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Ảnh đại
                                    diện</label>
                                <input name="avatar"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none "
                                    aria-describedby="file_input_help" id="file_input" type="file">
                                @error('avatar')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="date_of_birth" class="block mb-2 text-sm font-medium text-gray-900 ">Ngày
                                    sinh</label>
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('date')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 ">Giới
                                    tính</label>
                                <select id="gender" name="gender"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <option selected="">-- Giới tính --</option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                    <option value="3">Khác</option>
                                </select>
                                @error('gender')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="roleSelect" class="block mb-2 text-sm font-medium text-gray-900 ">Vai
                                    trò</label>
                                <select id="roleSelect" name="roleSelect"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <option selected>-- Vai trò --</option>
                                    <option value="1">Quản trị viên</option>
                                    <option value="2">Người dùng</option>
                                </select>
                                @error('roleSelect')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div id="permissionSelect">
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Quyền truy
                                    cập</label>
                                <select name="permissionSelect"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <option selected>-- Quyền truy cập --</option>
                                    <option value="3">Admin 1</option>
                                    <option value="4">Admin 2</option>
                                </select>
                                @error('permissionSelect')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Mật khẩu</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 ">Trạng thái</label>
                        <select name="status" id="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option selected>-- Trạng thái --</option>
                            <option value="1">Hoạt động</option>
                            <option value="2">Khóa tài khoản</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label for="province"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Tỉnh/Thành</label>
                                <select id="province" name="province"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <option selected="">-- Tỉnh/Thành --</option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                    <option value="3">Khác</option>
                                </select>
                                @error('province')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="district"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Huyện/Tỉnh</label>
                                <select id="district" name="district"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <option selected="">-- Huyện/Tỉnh --</option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                    <option value="3">Khác</option>
                                </select>
                                @error('district')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="ward"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Phường/Xã</label>
                                <select id="ward" name="ward"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <option selected="">-- Phường/Xã --</option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                    <option value="3">Khác</option>
                                </select>
                                @error('ward')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="detail_address" class="block mb-2 text-sm font-medium text-gray-900 ">Địa chỉ chi
                            tiết</label>
                        <input type="text" name="detail_address" id="detail_address"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('detail_address')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-5">
                    <a href="{{ route('admin.users.index') }}"
                        class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Quay lại
                    </a>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Thêm người dùng
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const permissionSelect = document.getElementById('permissionSelect');
        permissionSelect.style.display = 'none';
        document.getElementById('roleSelect').addEventListener('change', function() {
            if (this.value === '1') {
                permissionSelect.style.display = 'block';
            } else {
                permissionSelect.style.display = 'none';
            }
        });
    </script>
@endsection
