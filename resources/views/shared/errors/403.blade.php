@extends('layouts.shared')

@section('title', '403 Cấm')

@section('content')
    <div class="bg-gray-100">
        <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="text-center p-2">
                <h1 class="text-6xl md:text-9xl font-bold text-gray-800 mb-8">403</h1>
                <p class="text-2xl md:text-4xl font-medium text-gray-500 mb-4">Bạn bị chặn truy cập vào địa chỉ!</p>
                <p class="text-sm md:text-xl font-medium text-gray-500 mb-8">hoặc bạn không đủ quyền truy cập</p>
                <a href="{{ route('client.home') }}" class="button-red">Trở về trang chủ</a>
            </div>
        </div>
    </div>
@endsection
