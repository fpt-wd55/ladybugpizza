@extends('layouts.client')

@section('title', 'Liên hệ')

@section('content')
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif
    <div class="w-full md:w-[920px] h-[690px] md:mx-auto my-16 p-4 transition">
        <div class="md:grid md:grid-cols-2 gap-4 card overflow-hidden">
            <div class="p-4 md:p-6 lg:p-8">
                <div class="mb-4">
                    <div class="mb-4 font-semibold text-lg">
                        Liên hệ với chúng tôi
                    </div>
                    @session('success')
                        <div class="alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @endsession
                    @session('error')
                        <div class="alert-error mt-2">
                            {{ session('error') }}
                        </div>
                    @endsession
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="font-medium" for="fullname">Họ và tên</label>
                        <input type="text" name="fullname" id="fullname" value="{{ old('fullname') }}"
                            placeholder="VD: Trần Văn A" class="mt-2 mb-2 input">
                        @error('fullname')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="font-medium" for="phone">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            placeholder="VD: 0123456789" class="mt-2 mb-2 input">
                        @error('phone')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="font-medium" for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{ old('email') }}"
                            placeholder="VD: lazzybugpizza@gmail.com" class="mt-2 mb-2 input">
                        @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="font-medium" for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            placeholder="VD: Pizza ngon miệng" class="mt-2 mb-2 input">
                        @error('title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="font-medium" for="content">Nội dung</label>
                        <textarea type="text" name="content" id="content" value="{{ old('content') }}" class="mt-2 mb-2 text-area input"
                            cols="20" rows="5" placeholder="Viết suy nghĩ của bạn..."></textarea>
                        @error('content')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-start mt-4">
                        <button type="submit"
                            class="bg-red-600 flex items-center justify-center button-red w-28 h-6 md:w-full">
                            Gửi
                        </button>
                    </div>
                </form>
            </div>
            <div class="hidden md:block max-h-[662px]">
                <img class="w-full h-full object-cover" src=" {{ asset('storage/uploads/banners/auth_banner1.webp') }}"
                    alt="Ảnh sản phẩm">
            </div>
        </div>
    </div>
@endsection
