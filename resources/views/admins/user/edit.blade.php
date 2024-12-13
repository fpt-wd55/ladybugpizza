@extends('layouts.admin')

@section('title', 'Tài khoản | Cập nhật')

@section('content')
    {{ Breadcrumbs::render('admin.users.edit', $user) }}
    <div class="relative mt-5 overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="mx-auto p-4">
            <h3 class="mb-4 text-lg font-bold text-gray-900">Cập nhật tài khoản</h3>
            <form action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <div class="mb-4 grid grid-cols-3 gap-4 md:grid-cols-4 lg:grid-cols-7">
                        <a class="shrink-0" data-fslightbox="gallery" href="{{ $user->avatar() }}">
                            <img class="h-20 w-20 rounded-full object-cover" loading="lazy" src="{{ $user->avatar() }}">
                        </a>
                        <div class="col-span-2 flex w-full items-center justify-center md:col-span-3 lg:col-span-6">
                            <label
                                class="flex h-20 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100"
                                for="dropzone-file">
                                <div class="flex flex-col items-center justify-center">
                                    @svg('tabler-cloud-upload', 'w-8 h-8 text-gray-400 mb-2')
                                    <p class="mb-2 items-center text-center text-sm text-gray-500">
                                        <span class="font-semibold">Nhấn để tải lên</span>
                                        hoặc kéo thả vào đây
                                    </p>
                                </div>
                                <input class="hidden" id="dropzone-file" name="avatar" type="file" />
                            </label>
                        </div>
                    </div>
                    @error('avatar')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="sm:col-span-2">
                    <div class="mb-4 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <div>
                            <label class="label-md" for="username">Tên tài
                                khoản</label>
                            <input class="input" disabled id="username" name="username" placeholder="VD: ladybugpizza"
                                type="text" value="{{ old('username', $user->username) }}">
                            @error('username')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="label-md" for="fullname">Họ và
                                tên <span class="text-red-500">*</span></label>
                            <input class="input" id="fullname" name="fullname" placeholder="VD: Trần Văn A" type="text"
                                value="{{ old('fullname', $user->fullname) }}">
                            @error('fullname')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        @if ($user->google_id == null)
                            <div>
                                <label class="label-md" for="new_password">Mật khẩu mới</label>
                                <input class="input" id="new_password" name="new_password" type="password">
                                @error('new_password')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        @endif
                        <div>
                            <label class="label-md" for="email">Email <span class="text-red-500">*</span></label>
                            <input class="input" id="email" name="email" placeholder="VD: ladybugpizza@gmail.com"
                                type="text" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="label-md" for="phone">Số điện
                                thoại <span class="text-red-500">*</span></label>
                            <input class="input" id="phone" name="phone" placeholder="VD: 0123456789" type="text"
                                value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-4 block text-sm font-medium text-gray-900" for="gender">Giới
                                tính</label>
                            <div class="flex flex-wrap items-center">
                                <div class="mr-4 flex items-center">
                                    <input {{ old('gender', $user->gender) == 1 ? 'checked' : '' }} class="input-radio"
                                        id="male" name="gender" type="radio" value="1">
                                    <label class="ms-2 text-sm font-medium text-gray-900" for="male">Nam</label>
                                </div>
                                <div class="mr-4 flex items-center">
                                    <input {{ old('gender', $user->gender) == 2 ? 'checked' : '' }} class="input-radio"
                                        id="female" name="gender" type="radio" value="2">
                                    <label class="ms-2 text-sm font-medium text-gray-900" for="female">Nữ</label>
                                </div>
                                <div class="mr-4 flex items-center">
                                    <input {{ old('gender', $user->gender) == 3 ? 'checked' : '' }} class="input-radio"
                                        id="orther" name="gender" type="radio" value="3">
                                    <label class="ms-2 text-sm font-medium text-gray-900" for="orther">Khác</label>
                                </div>
                            </div>
                            @error('gender')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <div class="mb-4 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <div>
                            <label class="label-md" for="date_of_birth">Ngày
                                sinh <span class="text-red-500">*</span></label>
                            <input class="input" id="date_of_birth" name="date_of_birth" type="date"
                                value="{{ old('date_of_birth', $user->date_of_birth) }}">
                            @error('date_of_birth')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-4 block text-sm font-medium text-gray-900" for="status">Trạng
                                thái</label>
                            <label class="inline-flex cursor-pointer items-center">
                                <input {{ old('status', $user->status) == 1 ? 'checked' : '' }} class="peer sr-only"
                                    name="status" type="checkbox" value="1">
                                <div
                                    class="peer relative h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-0 rtl:peer-checked:after:-translate-x-full">
                                </div>
                                <span class="ms-3 text-sm font-medium text-gray-900">Hoạt
                                    động</span>
                            </label>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <div class="mb-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
                        <div>
                            <label class="label-md">Vai
                                trò</label>
                            <div class="flex flex-wrap">
                                <div class="my-3 mr-4 flex items-center">
                                    <input {{ old('roleSelect', $user->role->parent_id) == 1 ? 'checked' : '' }}
                                        class="input-radio" id="adminRole" name="roleSelect" type="radio"
                                        value="1">
                                    <label class="ms-2 text-sm font-medium text-gray-900" for="adminRole">Quản trị
                                        viên</label>
                                </div>
                                <div class="my-3 mr-4 flex items-center">
                                    <input {{ old('roleSelect', $user->role_id) == 2 ? 'checked' : '' }}
                                        class="input-radio" id="userRole" name="roleSelect" type="radio"
                                        value="2">
                                    <label class="ms-2 text-sm font-medium text-gray-900" for="userRole">Khách
                                        hàng</label>
                                </div>
                            </div>
                            @error('roleSelect')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div id="permissionSelect">
                            <label class="label-md" for="category">Phân
                                quyền <span class="text-red-500">*</span></label>
                            <select class="select" name="permissionSelect">
                                <option disabled selected>Phân quyền</option>
                                @foreach ($permissions as $permission)
                                    <option {{ $user->role_id == $permission->id ? 'selected' : '' }}
                                        value="{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('permissionSelect')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-5 flex items-center space-x-4">
                    <a class="button-gray" href="{{ route('admin.users.index') }}">
                        Quay lại
                    </a>
                    <button class="button-blue" type="submit">
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
