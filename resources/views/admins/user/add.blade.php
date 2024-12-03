@extends('layouts.admin')
@section('title', 'Tài khoản | Thêm mới')
@section('content')
    {{ Breadcrumbs::render('admin.users.create') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Thêm tài khoản</h3>
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4">
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 md:grid-cols-2 lg:grid-cols-3">
                            <div>
                                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Tên tài
                                    khoản</label>
                                <input type="text" name="username" id="username" placeholder="Tên tài khoản"
                                    value="{{ old('username') }}"
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
                                    value="{{ old('fullname') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('fullname')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Mật khẩu</label>
                                <input type="password" name="password" id="password" placeholder="Mật khẩu"
                                    value="{{ old('password') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 md:grid-cols-2">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                                <input type="text" name="email" id="email" placeholder="email@domain.com"
                                    value="{{ old('email') }}"
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
                                    value="{{ old('phone') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 md:grid-cols-2 lg:grid-cols-3">
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
                                    value="{{ old('date_of_birth') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('date_of_birth')
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
                                            {{ old('gender') == 1 ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-0 focus:outline-none">
                                        <label for="male" class="ms-2 text-sm font-medium text-gray-900">Nam</label>
                                    </div>
                                    <div class="flex items-center mr-4">
                                        <input id="female" type="radio" value="2" name="gender"
                                            {{ old('gender') == 2 ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-0 focus:outline-none">
                                        <label for="female" class="ms-2 text-sm font-medium text-gray-900">Nữ</label>
                                    </div>
                                    <div class="flex items-center mr-4">
                                        <input id="orther" type="radio" value="3" name="gender"
                                            {{ old('gender') == 3 ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-0 focus:outline-none">
                                        <label for="orther" class="ms-2 text-sm font-medium text-gray-900">Khác</label>
                                    </div>
                                </div>
                                @error('gender')
                                    <p class="mt-5 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 lg:grid-cols-3">
                            <div>
                                <label for="status" class="block mb-4 text-sm font-medium text-gray-900 ">Trạng
                                    thái</label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="status" class="sr-only peer" value="1"
                                        {{ old('status') ? 'checked' : '' }}>
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
                            <div>
                                <label class="block mb-3 text-sm font-medium text-gray-900 ">Vai
                                    trò</label>
                                <div class="flex flex-wrap mb-2">
                                    <div class="flex items-center mb-4 mr-4">
                                        <input id="adminRole" type="radio" value="1" name="roleSelect"
                                            {{ old('roleSelect') == 1 ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-0 focus:outline-none">
                                        <label for="adminRole" class="ms-2 text-sm font-medium text-gray-900">Quản trị
                                            viên</label>
                                    </div>
                                    <div class="flex items-center mb-4 mr-4">
                                        <input id="userRole" type="radio" value="2" name="roleSelect"
                                            {{ old('roleSelect') == 2 ? 'checked' : '' }}
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
                                            {{ old('permissionSelect') == $permission->id ? 'selected' : '' }}>
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
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label for="province"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Tỉnh/Thành</label>
                                <select id="province" name="province"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
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
                                    <option value="">Chọn quận/huyện</option>
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
                                    <option value="">Chọn phường/xã</option>
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
                            placeholder="VD: Số 4 ngõ 2 ngách 14 đường Cầu Diễn" value="{{ old('detail_address') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('detail_address')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-5">
                    <a href="{{ route('admin.users.index') }}" class="button-gray">
                        Quay lại
                    </a>
                    <button type="submit" class="button-blue">
                        Thêm tài khoản
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <script>
        $(document).ready(function() {
            // Load provinces on page load
            // $.getJSON('/api/provinces', function(data) {
            //     const provinceSelect = $('#province');
            //     data.forEach(province => {
            //         provinceSelect.append(new Option(province.name, province.code));
            //     });
            // });

            // Cố định Hà Nội
            const provinceSelect = $('#province');
            provinceSelect.append(new Option('Hà Nội', '01')).val('01').prop('disabled', false);

            // Load districts when a province is selected
            // $('#province').change(function() {
            const provinceCode = '01'; // Mã cố định của Hà Nội
            const districtSelect = $('#district');
            districtSelect.empty().append(new Option('Chọn Quận/Huyện', '')).prop('disabled', true);

            if (provinceCode) {
                $.getJSON(`/api/districts/${provinceCode}`, function(data) {
                    districtSelect.prop('disabled', false);
                    data.forEach(district => {
                        districtSelect.append(new Option(district.name, district.code));
                    });
                });
            }

            // Reset wards
            $('#ward').empty().append(new Option('Chọn Phường/Xã', '')).prop('disabled', true);
            // });

            // Load wards when a district is selected
            $('#district').change(function() {
                const districtCode = $(this).val();
                const wardSelect = $('#ward');
                wardSelect.empty().append(new Option('Chọn Phường/Xã', '')).prop('disabled', true);

                if (districtCode) {
                    $.getJSON(`/api/wards/${districtCode}`, function(data) {
                        wardSelect.prop('disabled', false);
                        data.forEach(ward => {
                            wardSelect.append(new Option(ward.name, ward.code));
                        });
                    });
                }
            });
        });
    </script>
@endsection
