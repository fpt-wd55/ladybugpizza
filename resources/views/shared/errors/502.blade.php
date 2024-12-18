@extends('layouts.shared')

@section('title', '502')

@section('content')
    <div class="bg-gray-100">
        <div class="flex min-h-screen items-center justify-center bg-gray-100">
            <div class="p-2 text-center">
                <h1 class="mb-8 text-7xl font-bold text-gray-800 md:text-8xl">502</h1>
                <p class="mb-4 text-2xl font-medium text-gray-500">Phản hồi không hợp lệ</p>
                <p class="mb-8 text-sm text-gray-500">Máy chủ nhận được phản hồi không hợp lệ. Vui lòng thử lại sau.</p>
                <a href="{{ route('client.home') }}">
                    <button class="button-red mx-auto">Trang chủ</button>
                </a>
            </div>
        </div>
    </div>
@endsection
