@extends('layouts.client')

@section('title', 'Tài khoản và bảo mật')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="lg:flex">
            @include('clients.profile.sidebar')

            <div class="card p-4 md:p-8 w-full min-h-screen">
                <h3 class="font-semibold uppercase mb-8">hồ sơ của tôi</h3>
                <div class="grid grid-cols-1 lg:grid-cols-3">

                    <div class="col-span-1 flex flex-col items-center mb-8 gap-4">
                        <form action="{{ route('client.profile.post-update') }}" class="mb-8" method="POST" enctype="multipart/form-data">
                            {{-- update info form --}}

                            @csrf
                            @method('PUT')
                            <img loading="lazy" class="img-circle img-lg object-cover"
                                src="{{ $user->avatar ? asset('storage/uploads/avatars/' . $user->avatar) : asset('images/default-avatar.png') }}"
                                alt="" width="150" height="150">

                            <!-- Input để upload file -->
                            <input type="file" id="avatar" name="avatar" class="hidden">
                            <label for="avatar" class="button-red cursor-pointer mt-4">Chọn ảnh</label>

                            @error('avatar')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                    </div>

                    <div class="col-span-2">


                        <div class="mb-6 flex items-center">
                            <label class="text-sm font w-32 font-medium">Tên tài khoản:</label>
                            <span class="badge-red" name="username">{{ $user->username }}</span>
                        </div>

                        <div class="mb-6 flex items-center gap-8">
                            <label class="text-sm font w-32 font-medium">Họ và tên:</label>

                            <input type="text" class="input" name="fullname"
                                value="{{ old('fullname', $user->fullname) }}">
                        </div>

                        <div class="mb-6 flex items-center gap-8">
                            <label class="text-sm font w-32 font-medium">Email:</label>

                            <input type="email" class="input" name="email" value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="mb-6 flex items-center gap-8">
                            <label class="text-sm font w-32 font-medium">Số điện thoại:</label>

                            <input type="text" class="input" name="phone" value="{{ old('phone', $user->phone) }}">
                        </div>
                        <div class="mb-6 flex items-center">
                            <p class="text-sm font w-32 font-medium">Giới tính:</p>
                            <div class="flex items-center gap-4 text-sm">
                                <label for="male">
                                    <input type="radio" name="gender" value="male" id="male" class="input-radio"
                                        {{ $user->gender == 1 ? 'checked' : '' }}>
                                    Nam
                                </label>
                                <label for="female">
                                    <input type="radio" name="gender" value="female" id="female" class="input-radio"
                                        {{ $user->gender == 2 ? 'checked' : '' }}>
                                    Nữ
                                </label>
                                <label for="other">
                                    <input type="radio" name="gender" value="other" id="other" class="input-radio"
                                        {{ $user->gender == 3 ? 'checked' : '' }}>
                                    Khác
                                </label>
                            </div>
                        </div>

                        <div class="mb-6 flex items-center gap-8">
                            <label class="text-sm font-medium w-32">Ngày sinh:</label>

                            <input type="date" class="input" name="date_of_birth"
                                value="{{ old('date_of_birth', $user->date_of_birth) }}">
                        </div>

                        <div class="mb-6 flex justify-end">
                            <button type="submit" class="button-red">
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
                                <label class="text-sm font w-32 font-medium">Mật khẩu cũ:</label>
                                <input type="password" class="input" name="current_password">
                                @error('current_password')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror

                            </div>

                            <!-- Mật khẩu mới -->
                            <div class="mb-6 flex items-center gap-8">
                                <label class="text-sm font w-32 font-medium">Mật khẩu mới:</label>
                                <input type="password" class="input" name="new_password">
                                @error('new_password')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nhập lại mật khẩu mới -->
                            <div class="mb-6 flex items-center gap-8">
                                <label class="text-sm font w-32 font-medium">Nhập lại mật khẩu:</label>
                                <input type="password" class="input" name="new_password_confirmation">
                                @error('new_password_confirmation')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6 flex justify-end">
                                <button type="submit" class="button-red">
                                    @svg('tabler-cloud-upload', 'icon-sm me-2')
                                    Đổi mật khẩu
                                </button>
                            </div>
                        </form>


                        {{-- Form inactive account --}}
                        <div class="mb-8">
                            <p class="title">HUỶ KÍCH HOẠT TÀI KHOẢN</p>
                            <p class="text-sm mb-4">Tài khoản của bạn sẽ bị vô hiệu hoá nhưng thông tin của bạn vẫn được
                                lưu
                                trữ, bạn có thể khôi phục lại bất kỳ lúc nào</p>
                            <p class="text-sm mb-4">Chúng tôi sẽ yêu cầu mật khẩu để xác nhận hành động này</p>
                            <div class="mb-6 flex justify-end">
                                <button type="submit" class="button-red" data-modal-target="inactiveModal"
                                    data-modal-toggle="inactiveModal">
                                    @svg('tabler-lock', 'icon-sm me-2')
                                    Huỷ kích hoạt
                                </button>
                            </div>
                            {{-- Inactive Modal --}}
                            <div id="inactiveModal" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                <div class="relative p-4 w-full max-w-2xl h-auto">
                                    <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                                        <div
                                            class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Hủy kích hoạt tài khoản
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="inactiveModal">
                                                @svg('tabler-x', 'icon-sm')
                                            </button>
                                        </div>
                                        <p class="text-sm mb-8">Bạn cần nhập mật khẩu để xác nhận hành vi của mình</p>
                                        <form action="{{ route('client.profile.post-inactive') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="name"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mật
                                                        khẩu</label>
                                                    <input type="password" name="password" id="name" value=""
                                                        class="input" placeholder="">
                                                    @error('password')
                                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <button type="submit" class="button-red">
                                                    Xác nhận
                                                </button>
                                                <button type="button" class="button-dark"
                                                    data-modal-hide="inactiveModal">
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
