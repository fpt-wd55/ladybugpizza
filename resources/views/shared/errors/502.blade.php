@extends('layouts.shared')

@section('title', '502 Cổng xấu')

@section('content')
    <div class="bg-gray-100">
        <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="text-center p-2">
                <h1 class="text-6xl md:text-9xl font-bold text-gray-800 mb-8">502</h1>
                <p class="text-2xl md:text-4xl font-medium text-gray-500 mb-4">Cổng xấu</p>
                <p class="text-sm md:text-xl font-medium text-gray-500 mb-8">Phản hồi không hợp lệ</p>
                <a href="{{ route('client.home') }}" class="button-red">Trang chủ </a>
            </div>
        </div>
    </div>
@endsection
