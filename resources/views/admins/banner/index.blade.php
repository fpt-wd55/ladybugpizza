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
                <a class="button-blue" href="{{ route('admin.banners.create') }}">
                    @svg('tabler-plus', 'w-5 h-5 mr-2')
                    Thêm banner
                </a>
                <a class="button-red" href="{{ route('admin.trash.listBanner') }}">
                    @svg('tabler-trash', 'w-5 h-5 mr-2')
                    Thùng rác
                </a>
                <a class="button-light" href="{{ route('admin.banners.export') }}">
                    @svg('tabler-file-export', 'w-4 h-4 mr-2')
                    Xuất dữ liệu
                </a>
            </div>
        </div>
        <div class="flex flex-col space-y-3 border-t px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
            <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">

            </div>
            <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                <div class="flex w-full items-center md:w-auto">
                    <button class="flex w-full items-center justify-center button-light" data-modal-target="filterDropdown" data-modal-toggle="filterDropdown" type="button">
                        @svg('tabler-filter-filled', 'w-5 h-5 me-2')
                        Bộ lọc
                    </button>
                    <form action="{{ route('admin.banner.filter') }}" aria-hidden="true" class="fixed inset-0 z-50 hidden h-modal w-full overflow-y-auto overflow-x-hidden p-4 md:h-full" id="filterDropdown" method="get" tabindex="-1">
                        <div class="relative h-full w-full max-w-xl md:h-auto">
                            <!-- Modal content -->
                            <div class="relative rounded-lg bg-white shadow">
                                <!-- Modal header -->
                                <div class="flex items-start justify-between rounded-t px-6 py-4">
                                    <h3 class="text-lg font-semibold text-gray-500">
                                        Bộ lọc
                                    </h3>
                                    <button class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-toggle="filterDropdown" type="button">
                                        @svg('tabler-x', 'w-5 h-5')
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="px-4 md:px-6">
                                    <h6 class="my-3 text-sm font-medium text-gray-900">Loại trang</h6>
                                    <ul class="space-y-2 text-sm">
                                        <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                            <li class="flex items-center">
                                                <input @if (in_array(1, request()->input('filter_is_local_page', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="local" name="filter_is_local_page[]" type="checkbox" value="1">
                                                <label class="ml-2 text-sm font-medium text-gray-900" for="local">Trang
                                                    cục bộ</label>
                                            </li>
                                            <li class="flex items-center">
                                                <input @if (in_array(2, request()->input('filter_is_local_page', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="external" name="filter_is_local_page[]" type="checkbox" value="2">
                                                <label class="ml-2 text-sm font-medium text-gray-900" for="external">Trang
                                                    bên ngoài</label>
                                            </li>
                                        </div>
                                    </ul>
                                    <h6 class="my-3 text-sm font-medium text-gray-900">Trạng thái</h6>
                                    <ul class="space-y-2 text-sm">
                                        <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                            <li class="flex items-center">
                                                <input @if (in_array(1, request()->input('filter_status', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="active" name="filter_status[]" type="checkbox" value="1">
                                                <label class="ml-2 text-sm font-medium text-gray-900" for="active">Hoạt
                                                    động</label>
                                            </li>
                                            <li class="flex items-center">
                                                <input @if (in_array(2, request()->input('filter_status', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="inactive" name="filter_status[]" type="checkbox" value="2">
                                                <label class="ml-2 text-sm font-medium text-gray-900" for="inactive">Khóa</label>
                                            </li>
                                        </div>
                                    </ul>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center space-x-4 rounded-b p-6">
                                    <button class="button-red" type="submit">
                                        Lọc banner
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- List banner --}}
        <div class="overflow-x-auto">
            <div class="grid grid-cols-1 gap-3 gap-x-3 px-2 md:grid-cols-3">
                @forelse ($banners as $item)
                    {{-- start card --}}
                    <div class="card h-auto border-gray-700 bg-slate-500 shadow">
                        <div class="h-52 overflow-hidden rounded-t">
                            <a class="overflow-hidden" data-fslightbox="gallery" href="{{ asset('storage/uploads/banners/' . $item->image) }}">
                                <img class="h-full w-full object-cover transition hover:scale-105" loading="lazy" src="{{ asset('storage/uploads/banners/' . $item->image) }}">
                            </a>
                        </div>
                        <div class="flex items-start justify-between p-4">
                            <div class="flex justify-around">
                                <div class="">
                                    <div class="mb-2 flex items-center text-gray-900">
                                        <div class="indicator {{ $item->status == 1 ? 'bg-green-700' : 'bg-red-700' }} inline-block">
                                        </div>
                                        <span>{{ $item->status == 1 ? 'Hoạt động' : 'Khóa' }}</span>
                                    </div>
                                    <div class="text-center">
                                        <a class="text-sm text-gray-500 transition hover:scale-105 hover:bg-gray-100 hover:text-[#D30A0A] hover:underline" href="{{ $item->url }}" href="" target="blank">{{ $item->url }}</a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="inline-flex items-center rounded-lg p-0.5 text-center text-sm text-gray-500 hover:text-gray-800 focus:outline-none" data-dropdown-toggle="dropdown-menu-{{ $item->id }}" id="{{ $item->id }}" type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow" id="dropdown-menu-{{ $item->id }}">
                                    <ul aria-labelledby="dropdown-menu-{{ $item->id }}" class="py-1 text-sm text-gray-700">
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('admin.banners.edit', $item) }}">Cập nhật</a>
                                        </li>
                                        <li>
                                            <a class="block cursor-pointer px-4 py-2 text-sm text-red-500 hover:bg-gray-100" data-modal-target="deleteBanner-modal-{{ $item->id }}" data-modal-toggle="deleteBanner-modal-{{ $item->id }}" href="#">Xoá</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- start modal delete --}}
                    <div class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0" id="deleteBanner-modal-{{ $item->id }}" tabindex="-1">
                        <div class="relative max-h-full w-full max-w-md p-4">
                            <div class="relative rounded-lg bg-white shadow">
                                <button class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-hide="deleteBanner-modal-{{ $item->id }}" type="button">
                                    @svg('tabler-x', 'w-4 h-4')
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
