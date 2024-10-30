@extends('layouts.client')

@section('title', 'Tài khoản và bảo mật')

@section('content')
    <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
        <div class="lg:flex">
            @include('clients.profile.sidebar')

            <div class="card min-h-screen w-full p-4 md:p-8">
                <h3 class="mb-8 font-semibold uppercase">hồ sơ của tôi</h3>
                <div class="grid grid-cols-1 lg:grid-cols-3">

                    <div class="col-span-1 mb-8 flex flex-col items-center gap-4">
                        {{-- update info form --}}
                        <form action="{{ route('client.profile.post-update') }}" class="mb-8" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <img alt="" id="avatar-preview" class="img-circle img-lg object-cover" height="150" loading="lazy" src="{{ Auth::user()->avatar() }}" width="150">

                            <!-- Input để upload file -->
                            <input class="hidden" id="avatar" onchange="previewAvatar(event)" name="avatar" type="file">
                            <label class="button-dark mt-4 cursor-pointer" for="avatar">Chọn ảnh</label>

                            @error('avatar')
                                <p class="text-sm text-red-500 text-center">{{ $message }}</p>
                            @enderror
                    </div>

                    <div class="col-span-2">

                        <div class="mb-6 flex items-center">
                            <label class="font w-32 text-sm font-medium">Tên tài khoản:</label>
                            <span class="badge-red" name="username">{{ $user->username }}</span>
                        </div>

                        <div class="mb-6 flex items-center gap-8">
                            <label class="font w-32 text-sm font-medium">Họ và tên:</label>

                            <input class="input" name="fullname" type="text" value="{{ old('fullname', $user->fullname) }}">
                        </div>

                        <div class="mb-6 flex items-center gap-8">
                            <label class="font w-32 text-sm font-medium">Email:</label>

                            <input class="input" name="email" type="email" value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="mb-6 flex items-center gap-8">
                            <label class="font w-32 text-sm font-medium">Số điện thoại:</label>

                            <input class="input" name="phone" type="text" value="{{ old('phone', $user->phone) }}">
                        </div>
                        <div class="mb-6 flex items-center">
                            <p class="font w-32 text-sm font-medium">Giới tính:</p>
                            <div class="flex items-center gap-4 text-sm">
                                <label for="male">
                                    <input {{ $user->gender == 1 ? 'checked' : '' }} class="input-radio" id="male" name="gender" type="radio" value="male">
                                    Nam
                                </label>
                                <label for="female">
                                    <input {{ $user->gender == 2 ? 'checked' : '' }} class="input-radio" id="female" name="gender" type="radio" value="female">
                                    Nữ
                                </label>
                                <label for="other">
                                    <input {{ $user->gender == 3 ? 'checked' : '' }} class="input-radio" id="other" name="gender" type="radio" value="other">
                                    Khác
                                </label>
                            </div>
                        </div>

                        <div class="mb-6 flex items-center gap-8">
                            <label class="w-32 text-sm font-medium">Ngày sinh:</label>

                            <input class="input" name="date_of_birth" type="date" value="{{ old('date_of_birth', $user->date_of_birth) }}">
                        </div>

                        <div class="mb-6 flex justify-end">
                            <button class="button-red" type="submit">
                                @svg('tabler-cloud-upload', 'icon-sm me-2')
                                Cập nhật
                            </button>
                        </div>
                        </form>


                        {{-- Change password form --}}
                        <form action="{{ route('client.profile.post-change-password') }}" class="mb-8" method="POST">
                            @csrf
                            @method('PUT')
                            <p class="title">ĐỔI MẬT KHẨU</p>

                            <!-- Mật khẩu cũ -->
                            <div class="mb-6 flex items-center gap-8">
                                <label class="font w-32 text-sm font-medium">Mật khẩu cũ:</label>
                                <input class="input" name="current_password" type="password">
                                @error('current_password')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror

                            </div>

                            <!-- Mật khẩu mới -->
                            <div class="mb-6 flex items-center gap-8">
                                <label class="font w-32 text-sm font-medium">Mật khẩu mới:</label>
                                <input class="input" name="new_password" type="password">
                                @error('new_password')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nhập lại mật khẩu mới -->
                            <div class="mb-6 flex items-center gap-8">
                                <label class="font w-32 text-sm font-medium">Nhập lại mật khẩu:</label>
                                <input class="input" name="new_password_confirmation" type="password">
                                @error('new_password_confirmation')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6 flex justify-end">
                                <button class="button-red" type="submit">
                                    @svg('tabler-cloud-upload', 'icon-sm me-2')
                                    Đổi mật khẩu
                                </button>
                            </div>
                        </form>


                        {{-- Form inactive account --}}
                        <div class="mb-8">
                            <p class="title">HUỶ KÍCH HOẠT TÀI KHOẢN</p>
                            <p class="mb-4 text-sm">Tài khoản của bạn sẽ bị vô hiệu hoá nhưng thông tin của bạn vẫn được
                                lưu
                                trữ, bạn có thể khôi phục lại bất kỳ lúc nào</p>
                            <p class="mb-4 text-sm">Chúng tôi sẽ yêu cầu mật khẩu để xác nhận hành động này</p>
                            <div class="mb-6 flex justify-end">
                                <button class="button-red" data-modal-target="inactiveModal" data-modal-toggle="inactiveModal" type="submit">
                                    @svg('tabler-lock', 'icon-sm me-2')
                                    Huỷ kích hoạt
                                </button>
                            </div>
                            {{-- Inactive Modal --}}
                            <div aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 md:h-full" id="inactiveModal" tabindex="-1">
                                <div class="relative h-auto w-full max-w-2xl p-4">
                                    <div class="relative rounded-lg bg-white p-4 shadow sm:p-5">
                                        <div class="mb-4 flex items-center justify-between rounded-t border-b pb-4 sm:mb-5">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Hủy kích hoạt tài khoản
                                            </h3>
                                            <button class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="inactiveModal" type="button">
                                                @svg('tabler-x', 'icon-sm')
                                            </button>
                                        </div>
                                        <p class="mb-8 text-sm">Bạn cần nhập mật khẩu để xác nhận hành vi của mình</p>
                                        <form action="{{ route('client.profile.post-inactive') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-4 grid gap-4 sm:grid-cols-2">
                                                <div class="col-span-2">
                                                    <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white" for="name">Mật
                                                        khẩu</label>
                                                    <input class="input" id="name" name="password" placeholder="" type="password" value="">
                                                    @error('password')
                                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <button class="button-red" type="submit">
                                                    Xác nhận
                                                </button>
                                                <button class="button-gray" data-modal-hide="inactiveModal" type="button">
                                                    Huỷ
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
