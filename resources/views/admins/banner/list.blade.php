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
            <a href="{{route('admin.trash.listBanner')}}"
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
                {{-- start card --}}
               <div class="card bg-slate-500 h-auto">
                <div class="">
                    <img src="{{asset('storage/uploads/banners/banner.jpg')}}" class="w-full h-full object-cover rounded-t-lg" alt="">
                </div>
                <div class="p-3 mb-2">
                   
                    <span class="text-xs  md:text-sm break-all badge-default">https://vieclam.thegioididong.com/tin-tuc/banner-la-gi-kich-thuoc-tieu-chuan-va-cach-thiet-ke-banner-thu-hut-357</span>
                </div>
                <div class="grid grid-cols-2 grid-rows-1 mb-5">
                    <div class="flex items-center">
                        <p class="text-sm font-medium ml-2">Page : </p>
                        <span class="bg-green-100 ml-2 text-green-600 font-medium px-3 py-1 rounded-lg border border-green-200">
                            Local Page
                          </span>
                    </div>
                    <div class="flex items-center ">
                        <p class="text-sm font-medium">Trạng thái :   </p>
                        <span class="bg-green-100 ml-2 text-green-600 font-medium px-3 py-1 rounded-lg border border-green-200">
                            Active
                          </span>
                        
                    </div>
                </div>
                <div class="grid grid-cols-2 justify-center mb-5">
                    <a href="" class="ml-5"><button class="button-blue">Chỉnh sửa</button></a>
                    <a href="" class="ml-10"><button class="button-red">Xóa</button></a>
                </div>
               </div>
                {{-- end card --}}


               <div class="card"></div>
               <div class="card"></div>
            </div>
        </div>
    </div>
@endsection
