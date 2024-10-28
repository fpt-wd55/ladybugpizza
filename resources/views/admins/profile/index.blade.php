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
                <img id="avatar-preview" loading="lazy" class="w-8 h-8 rounded-full"
                    src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('storage/uploads/avatars/user-default.png') }}">
                <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*"
                    onchange="previewAvatar(event)">
                <label for="avatar"
                    class="cursor-pointer px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                    Chọn ảnh
                </label>
                @error('avatar')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Business Profile -->
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
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <div class="grid grid-cols-2 gap-2">
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input" required>
                    @error('email')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <div class="mb-6 w-[50%]">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ngày sinh</label>
                    <input class="input w-32" name="date_of_birth" type="date" value="{{ $user->date_of_birth }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Giới tính</label>
                    <div class="flex items-center gap-4 text-sm">
                        <label for="male">
                            <input {{ $user->gender == 1 ? 'checked' : '' }} class="input-radio" id="male"
                                name="gender" type="radio" value="1">
                            Nam
                        </label>
                        <label for="female">
                            <input {{ $user->gender == 2 ? 'checked' : '' }} class="input-radio" id="female"
                                name="gender" type="radio" value="2">
                            Nữ
                        </label>
                        <label for="other">
                            <input {{ $user->gender == 3 ? 'checked' : '' }} class="input-radio" id="other"
                                name="gender" type="radio" value="3">
                            Khác
                        </label>
                    </div>
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
