@extends('layouts.shared')

@section('title', '504')

@section('content')
    <div class="bg-red-100">
        <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="text-center p-2">
                <h1 class="mb-8 text-7xl font-bold text-gray-800 md:text-8xl">504</h1>
                <p class="text-2xl font-medium text-gray-500 mb-4">Hết thời gian chờ</p>
                <p class="text-sm text-gray-500 mb-8">Thời gian chờ kết nối đã hết. Vui lòng thử lại sau hoặc liên hệ với chúng tôi nếu vấn đề tiếp tục.</p>
                <a href="{{ route('client.home') }}">
                    <button class="button-red mx-auto">Trang chủ</button>
                </a>
            </div>
        </div>
    </div>
@endsection
