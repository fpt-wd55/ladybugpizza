@extends('layouts.shared')

@section('title', '404')

@section('content')
    <div class="bg-gray-100">
        <div class="flex min-h-screen items-center justify-center bg-gray-100">
            <div class="p-2 text-center">
                <h1 class="mb-8 text-7xl font-bold text-gray-800 md:text-8xl">404</h1>
                <p class="mb-4 text-2xl font-medium text-gray-500">Không tìm thấy trang</p>
                <p class="mb-8 text-sm text-gray-500">Liên kết có thể bị hỏng hoặc trang đã bị xóa</p>
                <a href="{{ route('client.home') }}">
                    <button class="button-red mx-auto">Trang chủ</button>
                </a>
            </div>
        </div>
    </div>
@endsection
