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
            <div class="flex items-center gap-4 mb-8">
                <!-- Hiển thị ảnh đại diện -->
                <img id="avatar-preview"
                    src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}"
                    class="rounded-full object-cover" width="50" height="50" loading="lazy" alt="User Avatar">
                <!-- Input file để chọn ảnh (ẩn) -->
                <input type="file" id="avatar" name="avatar" class="hidden " accept="image/*"
                    onchange="previewAvatar(event)">
                <!-- Label dùng để trigger chọn ảnh -->
                <label for="avatar"
                    class="cursor-pointer px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                    Chọn ảnh
                </label>
                <!-- Hiển thị lỗi nếu có -->
                @error('avatar')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Business Profile -->
            <div class="mb-6">
                <div class="grid grid-cols-3 gap-4">
                    {{-- username --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tên tài khoản</label>
                        <input type="text" value="{{ $user->username }}" class="input">
                    </div>
                    {{-- fullname --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Họ và tên</label>
                        <input type="text" value="{{ $user->fullname }}" class="input">
                    </div>
                    {{-- phone --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                        <input type="text" value="{{ $user->phone }}" class="input">
                    </div>
                </div>
            </div>
            <!-- Email Section -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <div class="grid grid-cols-2 gap-2">
                    <input type="text" name="email" value="{{ old('email', $user->email) }}" class="input" >
                   
                </div>
                @error('email')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
            </div>
            <div class="mb-6">
                {{-- ngày sinh --}}
                <div class="mb-6 w-[50%]">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ngày sinh</label>
                    <input class="input w-32" name="date_of_birth" type="date" value="{{ $user->date_of_birth }}">
                </div>
                {{-- giới tính --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Giới tính</label>
                    <div class="flex items-center gap-4 text-sm">
                        <label for="male">
                            <input {{ $user->gender == 1 ? 'checked' : '' }} class="input-radio" id="male" name="gender" type="radio" value="1"> Nam
                        </label>
                        <label for="female">
                            <input {{ $user->gender == 2 ? 'checked' : '' }} class="input-radio" id="female" name="gender" type="radio" value="2"> Nữ
                        </label>
                        <label for="other">
                            <input {{ $user->gender == 3 ? 'checked' : '' }} class="input-radio" id="other" name="gender" type="radio" value="3"> Khác
                        </label>
                    </div>
                    
                </div>
            </div>
            {{-- password --}}
            <div class="mb-6">
                <div class="grid grid-cols-3 gap-4">
                    {{-- Mật khẩu cũ --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu cũ</label>
                        <input type="password" value="" class="input">
                    </div>
                    {{-- Mật khẩu mới --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu mới</label>
                        <input type="password" value="" class="input">
                    </div>
                    {{-- Nhập lại mật khẩu mới --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nhập lại mật khẩu mới</label>
                        <input type="password" value="" class="input">
                    </div>
                </div>
            </div>
            <!-- Buttons -->
            <div class="flex justify-end gap-2">
                <button class="button-gray">Hủy</button>
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
