@extends('layouts.shared')

@section('title', '403')

@section('content')
    <div class="bg-gray-100">
        <div class="flex min-h-screen items-center justify-center bg-gray-100">
            <div class="p-2 text-center">
                <h1 class="mb-8 text-7xl font-bold text-gray-800 md:text-8xl">403</h1>
                <p class="mb-4 text-2xl font-medium text-gray-500">Bạn không có quyền truy cập!</p>
                <p class="mb-8 text-sm font-medium text-gray-500">Bạn không có quyền truy cập vào trang này. Nếu bạn nghĩ đây
                    là một lỗi, vui lòng liên hệ với quản trị viên để được hỗ trợ.</p>
                <a href="{{ route('client.home') }}">
                    <button class="button-red mx-auto">Trang chủ</button>
                </a>
            </div>
        </div>
    </div>
@endsection
