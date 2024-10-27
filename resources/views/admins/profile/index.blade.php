@extends('layouts.admin')
@section('title', 'Tài khoản')

@section('content')
    {{ Breadcrumbs::render('admin.profiles.index') }}
    <div class="mt-10 mx-4">
        <h1 class="text-2xl font-bold mb-6">Tài khoản</h1>
        <!-- Profile Picture -->
        <div class="flex items-center gap-4">
            <form action="{{ route('client.profile.post-update') }}" class="mb-8" enctype="multipart/form-data"
                method="POST">
                @csrf
                @method('PUT')
                <img alt="" class="img-circle img-lg object-cover" height="150" loading="lazy"
                    src="{{ Auth::user()->avatar() }}" width="150">

                <!-- Input để upload file -->
                <input class="hidden" id="avatar" name="avatar" type="file">


                @error('avatar')
                    <p class="text-sm text-red-500 text-center">{{ $message }}</p>
                @enderror
            </form>
            <label class="button-dark cursor-pointer" for="avatar">Chọn ảnh</label>
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
                <input type="text" value="{{ $user->email }}" class="input">
                <button class="button-blue w-24">Thay đổi</button>
            </div>
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
                        <input {{ $user->gender == 1 ? 'checked' : '' }} class="input-radio" id="male" name="gender"
                            type="radio" value="male">
                        Nam
                    </label>
                    <label for="female">
                        <input {{ $user->gender == 2 ? 'checked' : '' }} class="input-radio" id="female" name="gender"
                            type="radio" value="female">
                        Nữ
                    </label>
                    <label for="other">
                        <input {{ $user->gender == 3 ? 'checked' : '' }} class="input-radio" id="other" name="gender"
                            type="radio" value="other">
                        Khác
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
            <button class="button-blue">Cập nhật</button>
        </div>
    </div>
@endsection
