@extends('layouts.admin')
@section('title', 'Tài khoản')

@section('content')
    {{ Breadcrumbs::render('admin.profiles.index') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="mt-10 mx-4">
            <h1 class="text-2xl font-bold mb-6">Tài khoản</h1>
            <!-- Profile Picture -->
            <form action="{{ route('admin.profiles.update', $user) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="flex items-center gap-6 mb-8">
                    @if ($user->avatar && \Storage::exists('uploads/avatars/' . $user->avatar))
                        <img id="avatar-preview" src="{{ asset('storage/uploads/avatars/' . $user->avatar) }}"
                            alt="User Avatar" class="w-10 h-10 object-cover rounded-full">
                    @else
                        <img src="{{ asset('storage/uploads/avatars/user-default.png') }}" alt=""
                            class="w-10 h-10 object-cover rounded-full">
                    @endif
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
                    <span class="text-lg text-gray-900">{{ $user->fullname }}, {{ $user->email }},
                        {{ $user->phone }}</span>
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
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input mb-2">
                        @error('email')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ngày sinh</label>
                        <input class="input w-32" name="date_of_birth" type="date" value="{{ $user->date_of_birth }}">
                    </div>
                </div>
                {{-- gioi tinh --}}
                <div class="mb-6">
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
                {{-- mat khau --}}
                <div class="mb-6 grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu mới</label>
                        <input type="password" class="input mb-2" name="new_password"
                            placeholder="Nhập mật khẩu mới...">
                        @error('new_password')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu </label>
                        <input class="input mb-2" name="confirm_password" type="password" placeholder="Xác nhận mật khẩu...">
                        @error('confirm_password')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- button --}}
                <div class="flex justify-end gap-2">
                    <button class="button-gray" type="reset">Hủy</button>
                    {{-- <button class="button-blue" type="submit">Cập nhật</button> --}}
                    <button>
                        <a href="#" data-modal-target="update-modal-{{ $user->id }}"
                            data-modal-toggle="update-modal-{{ $user->id }}"
                            class="button-red">Cập nhật</a>
                    </button>
                     {{-- update modal --}}
                     <div id="update-modal-{{ $user->id }}" tabindex="-1"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="update-modal-{{ $user->id }}">
                                    @svg('tabler-x', 'w-4 h-4')
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <div class="flex justify-center">
                                        @svg('tabler-user-up', 'w-12 h-12 text-red-600 text-center mb-2')
                                    </div>
                                    <h3 class="mb-8 text-xl font-normal">Bạn chắc chắn thay đổi thông tin chứ?</h3>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                        method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Đồng ý
                                        </button>
                                    </form>
                                    <button data-modal-hide="update-modal-{{ $user->id }}" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Không</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end update modal --}}
                </div>
            </form>
        </div>
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
