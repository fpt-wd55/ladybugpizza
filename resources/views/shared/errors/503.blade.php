@extends('layouts.shared')

@section('title', '503')

@section('content')

@section('content')
    <div class="bg-gray-100">
        <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="text-center p-2">
                <h1 class="mb-8 text-7xl font-bold text-gray-800 md:text-8xl">503</h1>
                <p class="text-2xl font-medium text-gray-500 mb-4">Dịch vụ không khả dụng</p>
                <p class="text-sm text-gray-500 mb-8">Dịch vụ đang tạm thời không khả dụng. Xin vui
                    lòng thử lại sau.</p>
                <a href="{{ route('client.home') }}">
                    <button class="button-red mx-auto">Trang chủ</button>
                </a>
            </div>
        </div>
    </div>
@endsection
