@extends('layouts.shared')

@section('title', '404 Không tìm thấy')

@section('content')
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center p-2">
            <h1 class="text-6xl md:text-9xl font-bold text-gray-800">404</h1>
            <p class="text-2xl md:text-4xl font-medium text-gray-500 mt-6">Ồ ! Không tìm thấy trang ! </p>
            <p class="text-xl md:text-3xl text-gray-400 mt-2">liên kết có thể bị hỏng ,</p>
            <p class="text-sm md:text-xl font-medium text-gray-500 mt-2">hoặc trang đã bị xóa</p>
            <a href="#" class="inline-block mt-12 bg-black px-6 py-2 text-white rounded-md shadow-lg uppercase">Trở về trang chủ</a>
        </div>
    </div>
</body>
@endsection