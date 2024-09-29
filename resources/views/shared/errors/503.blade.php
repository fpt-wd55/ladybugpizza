@extends('layouts.shared')

@section('title', '502 Dịch vụ không có sẵn')

@section('content')
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center p-2">
            <h1 class="text-6xl md:text-9xl font-bold text-gray-800">503</h1>
            <p class="text-2xl md:text-4xl font-medium text-gray-500 mt-6">Dịch vụ không có sẵn</p>
            <p class="text-lg md:text-xl text-gray-400 mt-2">máy chủ tạm thời hoãn, hãy thử lại sau</p>
            <a href="#" class="inline-block mt-12 bg-black px-6 py-2 text-white rounded-md shadow-lg uppercase">Trở về trang chủ</a>
        </div>
    </div>
</body>
@endsection