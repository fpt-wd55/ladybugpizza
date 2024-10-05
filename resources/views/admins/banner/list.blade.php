@extends('layouts.admin')
@section('content')
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3 p-4">
            <a href="{{route('admin.banners.create')}}"
                class="flex items-center justify-center px-4 py-2 text-sm text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-0">
                @svg('tabler-plus', 'w-5 h-5 mr-2')
                Thêm banner
            </a>
            <a href=""
                class="flex items-center justify-center px-4 py-2 text-sm text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-0">
                @svg('tabler-trash', 'w-5 h-5 mr-2')
                Thùng rác
            </a>
            <a href=""
                class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0">
                @svg('tabler-rotate-clockwise', 'w-4 h-4 mr-2')
                Làm mới
            </a>
        </div>

        <div class="overflow-x-auto">
            <div class="grid grid-cols-3 gap-x-3 px-2">
               <div class="card bg-slate-500 h-auto ">
                <div class="">
                    <img src="{{asset('storage/uploads/banners/banner.jpg')}}" class="w-full h-full object-cover rounded-t-lg" alt="">
                </div>
                <div class=""></div>
                <div class=""></div>
               </div>
               <div class="card"></div>
               <div class="card"></div>
            </div>
        </div>
    </div>
@endsection
