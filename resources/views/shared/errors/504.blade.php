@extends('layouts.shared')

@section('title', '504 Hết thời gian chờ')

@section('content')
<div class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center p-2">
            <h1 class="text-6xl md:text-9xl font-bold text-gray-800 mb-8">504</h1>
            <p class="text-2xl md:text-4xl font-medium text-gray-500 mb-4">Hết thời gian chờ</p>
            <p class="text-sm md:text-xl font-medium text-gray-500 mb-8">Vui lòng thử lại sau</p>
            <a href="{{ route('client.home') }}" class="button-red">Trang chủ</a>
        </div>
    </div>
</div>
@endsection