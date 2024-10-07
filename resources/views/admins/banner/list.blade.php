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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-3 gap-3 px-2">
                @forelse ($banners as $item)
                    
                {{-- start card --}}
               <div class="card bg-slate-500 h-auto">
                <div class="h-44">
                    <img src="{{ asset('storage/uploads/banners/' . $item->image) }}" class="w-full h-full object-cover rounded-t-lg" alt="">
                </div>
                <div class="p-3 mb-2 h-28">
                   
                    <span class="  md:text-sm break-all badge-default">{{$item->url}}</span>
                </div>
                <div class="flex justify-around  mb-5">
                    <div class="flex items-center">
                        <p class="text-xs md:text-sm font-medium ml-2">Page : </p>
                       @if ($item->is_local_page == 1)  
                       <span class="text-xs lg:text-sm bg-green-100 ml-2 text-green-600 font-medium px-3 py-1 rounded-lg border border-green-200">
                           Local Page
                         </span>
                       @else  
                       <span class="text-xs lg:text-sm bg-green-100 ml-2 text-blue-600 font-medium px-3 py-1 rounded-lg border border-blue-200">
                         External Page
                       </span>
                       @endif
                    </div>
                    <div class="flex items-center ">
                        <p class="text-xs md:text-sm font-medium">Trạng thái :   </p>
                        @if ($item->status == 1)       
                        <span class="text-xs lg:text-sm bg-green-100 ml-1 lg:ml-2 text-green-600 font-medium px-3 py-1 rounded-lg border border-green-200">
                            Active
                          </span>
                        @else               
                        <span class="text-xs lg:text-sm bg-green-100 ml-1 lg:ml-2 text-red-600 font-medium px-3 py-1 rounded-lg border border-red-200">
                          Inactive
                        </span>
                        @endif
                          
                    </div>
                </div>
                <div class="flex mb-5 justify-around">
                    <div class="">
                        <a href="" class=""><button class="w-32 md:w-24 lg:w-32 button-blue">Sửa</button></a>
                    </div>
                    <div class="">
                        <a href="" class=""><button class="w-32 md:w-24 lg:w-32 button-red">Xóa</button></a>
                    </div>
                </div>
               </div>
                {{-- end card --}}
                @empty
                    
                @endforelse

            </div>
            <div class="p-4">
                {{ $banners->links() }}
            </div>
        </div>
    </div>
@endsection
