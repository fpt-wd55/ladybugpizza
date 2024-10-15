@extends('layouts.admin')
@section('title', 'Banner')
@section('content')
    {{ Breadcrumbs::render('admin.banners.index') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h2 class="font-medium text-gray-700 text-base">
                    Banner
                </h2>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <a href="{{ route('admin.banners.create') }}"
                    class="flex items-center justify-center px-4 py-2 text-sm text-white rounded-lg bg-blue-700 hover:bg-blue-800 ">
                    @svg('tabler-plus', 'w-5 h-5 mr-2')
                    Thêm banner
                </a>
                <a href="{{ route('admin.trash.listBanner') }}"
                    class="flex items-center justify-center px-4 py-2 text-sm text-white rounded-lg bg-red-700 hover:bg-red-800 ">
                    @svg('tabler-trash', 'w-5 h-5 mr-2')
                    Thùng rác
                </a>
                <button type="button"
                    class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0">
                    @svg('tabler-file-export', 'w-4 h-4 mr-2')
                    Xuất dữ liệu
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-3 gap-3 px-2">
                @forelse ($banners as $item)
                    {{-- start card --}}
                    <div class="shadow border-gray-700 bg-slate-500 h-auto card">
                        <div class="h-44 overflow-hidden">
                            <img loading="lazy" src="{{ asset('storage/uploads/banners/' . $item->image) }}"
                                class="w-full h-full object-cover hover:scale-125 transition rounded-t-lg" alt="">
                        </div>
                        <div class="flex justify-around">
                            <div class="flex items-center mt-2 text-lg font-medium text-gray-900">
                                <div
                                    class="inline-block indicator {{ $item->status == 1 ? 'bg-green-700' : 'bg-red-700' }}">
                                </div>
                                {{ $item->status == 1 ? 'Hoạt động' : 'Khóa' }}
                            </div>
                        </div>
                        <div class="text-center p-2 mb-2 min-h-24">
                            <span
                                class="text-sm text-gray-500 hover:underline hover:text-[#D30A0A] hover:scale-105 hover:bg-gray-100 transition">{{ $item->url }}
                            </span>
                        </div>
                        <div class="flex mb-5 justify-around">
                            <div class="">
                                <a href="{{ route('admin.banners.edit', $item) }}" class=""><button
                                        class="w-32 md:w-24 lg:w-32 button-blue"> Sửa @svg('tabler-edit', 'w-5 w-5 h-5 ml-1')</button></a>
                            </div>
                            <div class="">
                                <a href="#" data-modal-target="deleteBanner-modal-{{ $item->id }}"
                                    data-modal-toggle="deleteBanner-modal-{{ $item->id }}"
                                    class="w-32 md:w-24 lg:w-32 button-red">
                                    Xóa @svg('tabler-trash', 'w-5 w-5 h-5 ml-1')
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- start modal delete --}}
                    <div id="deleteBanner-modal-{{ $item->id }}" tabindex="-1"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="deleteBanner-modal-{{ $item->id }}">
                                    @svg('tabler-x', 'w-4 h-4')
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <div class="flex justify-center">
                                        @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                    </div>
                                    <h3 class="mb-5 font-normal">Bạn có muốn xóa Banner này không?</h3>
                                    <div class=" flex justify-center">

                                        <form action="{{ route('admin.banners.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="text-white bg-red-600 hover:bg-red-800  focus:outline-none  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Xóa
                                            </button>
                                        </form>

                                        <button data-modal-hide="deleteBanner-modal-{{ $item->id }}" type="button"
                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Không,
                                            trở lại</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end modal delete --}}
                    {{-- end card --}}
                @empty
                    <div
                        class="col-span-1 md:col-span-2 lg:col-span-3 flex flex-col  items-center justify-center  p-6 rounded-lg bg-white w-full h-96">
                        @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                        <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                    </div>
                @endforelse
            </div>
            <div class="p-4">
                {{ $banners->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
