@extends('layouts.shared')

@section('title', 'Thu thập thông tin người dùng')

@section('content')

<div class="container w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4">
    <div class="md:grid gap-4 card">
        <div class=" p-4 md:p-6 lg:p-8">
            <div class="mb-4">
                <div class="mb-4 font-semibold text-lg">
                    Cập nhật thông tin
                </div>
            </div>
            <form action="{{route('auth.post-user-info')}}" method="POST">
                @csrf
                <div class="flex items-center justify-between w-full md:grid-cols-2 gap-4">
                    <div class="mb-4 py-4 w-full">
                        <label class="font-medium" for="fullname">Họ và tên </label>
                        <input type="text" name="fullname" id="fullname" class="mt-2 mb-2 input">
                        @error('fullname')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4 py-4 w-full">
                        <label class="font-medium" for="date_of_birth">Ngày sinh </label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="mt-2 mb-2 input">
                        @error('date_of_birth')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center justify-between w-full md:grid-cols-2 gap-4">
                    <div class="mb-4 py-4 w-full">
                        <label class="font-medium" for="gender">Giới tính </label>
                        <select name="gender" id="gender" class="mt-2 mb-2 input">
                            <option value="">Chọn giới tính</option>
                            <option value="male">Nam</option>
                            <option value="female">Nữ</option>
                            <option value="other">Khác</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4 py-4 w-full">
                        <label class="font-medium" for="avatar">Ảnh đại diện </label>
                        <input type="file" name="avatar" id="avatar" class="mt-2 mb-2 input">
                        @error('avatar')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 py-4">
                    <label class="font-medium" for="address">Địa chỉ </label>
                    <input type="text" name="address" id="address" class="mt-2 mb-2 input">
                    @error('address')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                </div>
                <div class="flex items-center justify-end mt-14 gap-6">
                    <div class="bg-red-600 flex items-center justify-center button-red w-28">
                        <button type="submit" class="h-[32px] text-white">Hoàn tất</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
