@extends('layouts.admin')
@section('title', 'Tài khoản | Chỉnh sửa')
@section('content')
    {{ Breadcrumbs::render('admin.users.edit', $user) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Cập nhật tài khoản</h3>
            <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-12">
                            <img class="w-20 h-20 rounded-full"
                                src="{{ asset('storage/uploads/avatars/' . $user->avatar) }}">
                            <div class="flex items-center justify-center w-full col-span-5">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-20 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center">
                                        @svg('tabler-cloud-upload', 'w-8 h-8 text-gray-400 mb-2')
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Nhấn để tải lên</span> hoặc kéo thả vào đây</p>
                                    </div>
                                    <input id="dropzone-file" name="avatar" type="file" class="hidden" />
                                </label>
                                @error('avatar')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Tên tài
                                    khoản</label>
                                <input type="text" name="username" id="username" placeholder="Tên tài khoản"
                                    value="{{ old('username', $user->username) }}" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('username')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900 ">Họ và
                                    tên</label>
                                <input type="text" name="fullname" id="fullname" placeholder="Họ và tên"
                                    value="{{ old('fullname', $user->fullname) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('fullname')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 ">Mật
                                    khẩu mới</label>
                                <input type="password" name="new_password" id="new_password" placeholder="Mật khẩu mới"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('new_password')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                                <input type="text" name="email" id="email" placeholder="email@domain.com"
                                    value="{{ old('email', $user->email) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Số điện
                                    thoại</label>
                                <input type="text" name="phone" id="phone" placeholder="0123456789"
                                    value="{{ old('phone', $user->phone) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="gender" class="block mb-4 text-sm font-medium text-gray-900">Giới
                                    tính</label>
                                <div class="flex flex-wrap items-center">
                                    <div class="flex items-center mr-4">
                                        <input id="male" type="radio" value="1" name="gender"
                                            {{ old('gender', $user->gender) == 1 ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-0 focus:outline-none">
                                        <label for="male" class="ms-2 text-sm font-medium text-gray-900">Nam</label>
                                    </div>
                                    <div class="flex items-center mr-4">
                                        <input id="female" type="radio" value="2" name="gender"
                                            {{ old('gender', $user->gender) == 2 ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-0 focus:outline-none">
                                        <label for="female" class="ms-2 text-sm font-medium text-gray-900">Nữ</label>
                                    </div>
                                    <div class="flex items-center mr-4">
                                        <input id="orther" type="radio" value="3" name="gender"
                                            {{ old('gender', $user->gender) == 3 ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-0 focus:outline-none">
                                        <label for="orther" class="ms-2 text-sm font-medium text-gray-900">Khác</label>
                                    </div>
                                </div>
                                @error('gender')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label for="date_of_birth" class="block mb-2 text-sm font-medium text-gray-900 ">Ngày
                                    sinh</label>
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    value="{{ old('date_of_birth', $user->date_of_birth) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('date')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="status" class="block mb-4 text-sm font-medium text-gray-900 ">Trạng
                                    thái</label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" value="1" name="status" class="sr-only peer"
                                        {{ old('status', $user->status) == 1 ? 'checked' : '' }}>
                                    <div
                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                    </div>
                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Hoạt
                                        động</span>
                                </label>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 ">Vai
                                    trò</label>
                                <div class="flex flex-wrap">
                                    <div class="flex items-center mb-4 mr-4">
                                        <input id="adminRole" type="radio" value="1" name="roleSelect"
                                            {{ old('roleSelect', $user->role->parent_id) == 1 ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-0 focus:outline-none">
                                        <label for="adminRole" class="ms-2 text-sm font-medium text-gray-900">Quản trị
                                            viên</label>
                                    </div>
                                    <div class="flex items-center mb-4 mr-4">
                                        <input id="userRole" type="radio" value="2" name="roleSelect"
                                            {{ old('roleSelect', $user->role_id) == 2 ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-0 focus:outline-none">
                                        <label for="userRole" class="ms-2 text-sm font-medium text-gray-900">Khách
                                            hàng</label>
                                    </div>
                                </div>
                                @error('roleSelect')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div id="permissionSelect">
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Phân
                                    quyền</label>
                                <select name="permissionSelect"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <option selected disabled>Phân quyền</option>
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}"
                                            {{ $user->role_id == $permission->id ? 'selected' : '' }}>
                                            {{ $permission->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('permissionSelect')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-5">
                    <a href="{{ route('admin.users.index') }}" class="button-dark">
                        Quay lại
                    </a>
                    <button type="submit" class="button-blue">
                        Cập nhật tài khoản
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const adminRole = document.getElementById('adminRole');
            const userRole = document.getElementById('userRole');
            const permissionSelect = document.getElementById('permissionSelect');

            function toggleForm() {
                if (adminRole.checked) {
                    permissionSelect.style.display = 'block';
                } else {
                    permissionSelect.style.display = 'none';
                }
            }

            adminRole.addEventListener('change', toggleForm);
            userRole.addEventListener('change', toggleForm);

            toggleForm();
        });
    </script>
@endsection
