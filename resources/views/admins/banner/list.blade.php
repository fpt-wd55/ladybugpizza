@extends('layouts.admin')
@section('title', 'Banner')
@section('content')
    {{ Breadcrumbs::render('admin.banners.index') }}

    <div class="relative mt-5 overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="flex flex-col space-y-3 px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
            <div class="flex flex-1 items-center space-x-4">
                <h2 class="text-base font-medium text-gray-700">
                    Banner
                </h2>
            </div>
            <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                <a class="flex items-center justify-center rounded-lg bg-blue-700 px-4 py-2 text-sm text-white hover:bg-blue-800" href="{{ route('admin.banners.create') }}">
                    @svg('tabler-plus', 'w-5 h-5 mr-2')
                    Thêm banner
                </a>
                <a class="flex items-center justify-center rounded-lg bg-red-700 px-4 py-2 text-sm text-white hover:bg-red-800" href="{{ route('admin.trash.listBanner') }}">
                    @svg('tabler-trash', 'w-5 h-5 mr-2')
                    Thùng rác
                </a>
                <a class="hover:text-primary-700 flex flex-shrink-0 items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 hover:bg-gray-100 focus:z-10 focus:outline-none focus:ring-0" href="{{ route('admin.banners.export') }}">
                    @svg('tabler-file-export', 'w-4 h-4 mr-2')
                    Xuất dữ liệu
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <div class="grid grid-cols-1 gap-3 gap-x-3 px-2 md:grid-cols-2">
                @forelse ($banners as $item)
                    {{-- start card --}}
                    <div class="card h-auto border-gray-700 bg-slate-500 shadow">
                        <div class="h-80 overflow-hidden">
                            <a data-fslightbox="gallery" href="{{ asset('storage/uploads/banners/' . $item->image) }}">
                                <img class="h-full w-full rounded-t-lg object-cover transition hover:scale-110" loading="lazy" src="{{ asset('storage/uploads/banners/' . $item->image) }}">
                            </a>
                        </div>
                        <div class="flex justify-around">
                            <div class="mt-2 flex items-center text-lg font-medium text-gray-900">
                                <div class="indicator {{ $item->status == 1 ? 'bg-green-700' : 'bg-red-700' }} inline-block">
                                </div>
                                {{ $item->status == 1 ? 'Hoạt động' : 'Khóa' }}
                            </div>
                        </div>
                        <div class="min-h-24 mb-2 p-2 text-center">
                            <span class="text-sm text-gray-500 transition hover:scale-105 hover:bg-gray-100 hover:text-[#D30A0A] hover:underline">{{ $item->url }}
                            </span>
                        </div>
                        <div class="mb-5 flex justify-around">
                            <div class="">
                                <a class="" href="{{ route('admin.banners.edit', $item) }}"><button class="button-blue w-32 md:w-24 lg:w-32"> Sửa @svg('tabler-edit', 'w-5 w-5 h-5 ml-1')</button></a>
                            </div>
                            <div class="">
                                <a class="button-red w-32 md:w-24 lg:w-32" data-modal-target="deleteBanner-modal-{{ $item->id }}" data-modal-toggle="deleteBanner-modal-{{ $item->id }}" href="#">
                                    Xóa @svg('tabler-trash', 'w-5 w-5 h-5 ml-1')
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- start modal delete --}}
                    <div class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0" id="deleteBanner-modal-{{ $item->id }}" tabindex="-1">
                        <div class="relative max-h-full w-full max-w-md p-4">
                            <div class="relative rounded-lg bg-white shadow">
                                <button class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-hide="deleteBanner-modal-{{ $item->id }}" type="button">
                                    @svg('tabler-x', 'w-4 h-4')
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 text-center md:p-5">
                                    <div class="flex justify-center">
                                        @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                    </div>
                                    <h3 class="mb-5 font-normal">Bạn có muốn xóa Banner này không?</h3>
                                    <div class="flex justify-center">

                                        <form action="{{ route('admin.banners.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none" type="submit">
                                                Xóa
                                            </button>
                                        </form>

                                        <button class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100" data-modal-hide="deleteBanner-modal-{{ $item->id }}" type="button">Không,
                                            trở lại</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end modal delete --}}
                    {{-- end card --}}
                @empty
                    <div class="col-span-1 flex h-96 w-full flex-col items-center justify-center rounded-lg bg-white p-6 md:col-span-2 lg:col-span-3">
                        @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                        <p class="mt-4 text-sm text-gray-500">Dữ liệu trống</p>
                    </div>
                @endforelse

            </div>
            <div class="p-4">
                {{ $banners->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
