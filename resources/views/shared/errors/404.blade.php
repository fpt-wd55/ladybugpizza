@extends('layouts.shared')

@section('title', '404 Không tìm thấy')

@section('content')
    <div class="bg-gray-100">
        <div class="flex min-h-screen items-center justify-center bg-gray-100">
            <div class="p-2 text-center">
                <h1 class="mb-8 text-6xl font-bold text-gray-800 md:text-9xl">404</h1>
                <p class="mb-4 text-2xl font-medium text-gray-500">Ồ ! Không tìm thấy trang ! </p>
                <p class="mb-8 text-sm font-medium text-gray-500">liên kết có thể bị hỏng hoặc trang đã bị xóa</p>
                <a href="{{ route('client.home') }}">
                    <button class="button-red mx-auto">Trang chủ</button>
                </a>
            </div>
        </div>
    </div>

@endsection
