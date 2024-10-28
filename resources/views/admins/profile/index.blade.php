@extends('layouts.admin')
@section('title', 'Tài khoản')

@section('content')
    {{ Breadcrumbs::render('admin.profiles.index') }}
    <div class="mt-10 mx-4">
        <h1 class="text-2xl font-bold mb-6">Tài khoản</h1>
        <!-- Profile Picture -->
        <form action="{{ route('admin.profiles.update', $user) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="flex items-center gap-8 mb-8">
                <img id="avatar-preview" loading="lazy" class="w-10 h-10 rounded-full"
                    src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('storage/uploads/avatars/user-default.png') }}">
                <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*"
                    onchange="previewAvatar(event)">
                <label for="avatar"
                    class="cursor-pointer px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Chọn ảnh
                </label>
                @error('avatar')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <h2 class="text-xl font-bold mb-2">Hồ sơ</h2>
                <span class="text-xl text-gray-500">{{$user->fullname}}, {{$user->email}}, {{$user->phone}}</span>
            </div>
            <!--  Profile -->
            <div class="mb-6">
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tên tài khoản</label>
                        <input type="text" name="username" value="{{ $user->username }}" class="input">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Họ và tên</label>
                        <input type="text" name="fullname" value="{{ $user->fullname }}" class="input">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" class="input">
                    </div>
                </div>
            </div>
            <!-- Email Section -->
            <div class="mb-6 grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input">
                    @error('email')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ngày sinh</label>
                    <input class="input w-32" name="date_of_birth" type="date" value="{{ $user->date_of_birth }}">
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Giới tính</label>
                <div class="flex items-center gap-4 text-sm">
                    <label for="male">
                        <input {{ $user->gender == 1 ? 'checked' : '' }} class="input-radio" id="male" name="gender"
                            type="radio" value="1">
                        Nam
                    </label>
                    <label for="female">
                        <input {{ $user->gender == 2 ? 'checked' : '' }} class="input-radio" id="female" name="gender"
                            type="radio" value="2">
                        Nữ
                    </label>
                    <label for="other">
                        <input {{ $user->gender == 3 ? 'checked' : '' }} class="input-radio" id="other" name="gender"
                            type="radio" value="3">
                        Khác
                    </label>
                </div>
            </div>
            <div class="mb-6 grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu hiện tại</label>
                    <input type="password" class="input" name="current_password" placeholder="Nhập mật khẩu hiện tại">
                    @error('current_password')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu mới</label>
                    <input class="input" name="new_password" type="password" placeholder="Nhập mật khẩu mới">
                    @error('new_password')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="flex justify-end gap-2">
                <button class="button-gray" type="reset">Hủy</button>
                <button class="button-blue" type="submit">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection
<script>
    // Hiển thị ảnh preview khi người dùng chọn ảnh
    function previewAvatar(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('avatar-preview');
            output.src = reader.result; // Cập nhật src của ảnh preview
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
