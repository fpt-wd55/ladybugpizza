@extends('layouts.shared')

@section('title', '504 Hết thời gian chờ')

@section('content')
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center p-2">
            <h1 class="text-6xl md:text-9xl font-bold text-gray-800">504</h1>
            <p class="text-2xl md:text-4xl font-medium text-gray-500 mt-6">Hết thời gian chờ</p>
            <p class="text-lg md:text-xl text-gray-400 mt-2">vui lòng thử lại</p>
            <a href="#" class="inline-block mt-12 bg-black px-6 py-2 text-white rounded-md shadow-lg uppercase">Trở về trang chủ</a>
        </div>
    </div>
</body>
@endsection