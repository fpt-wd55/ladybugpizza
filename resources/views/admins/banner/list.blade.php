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
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4 border-t">
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <div class="flex items-center space-x-3 w-full md:w-full">
                    <div class="flex items-center w-full">
                        <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                            class="w-full md:w-auto flex items-center justify-center py-2 ps-2 pe-3 me-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                            type="button">
                            @svg('tabler-chevron-down', 'w-5 h-5 me-3')
                            Hành động
                        </button>
                        <h2 class="font-medium text-gray-700 text-base italic" id="selectedItems">
                        </h2>
                    </div>
                    <div id="actionsDropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Kích hoạt/Khóa</a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Xóa tài khoản</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <form class="flex w-full md:w-40 lg:w-64" action="{{ route('admin.users.search') }}">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            @svg('tabler-search', 'w-5 h-5 text-gray-400')
                        </div>
                        <input type="text" name="search" class="input ps-10" placeholder="Tìm kiếm..." />
                    </div>
                </form>
                <div class="flex items-center space-x-3 w-full md:w-auto">
                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                        type="button">
                        @svg('tabler-filter-filled', 'w-5 h-5 me-2')
                        Bộ lọc
                        @svg('tabler-chevron-down', 'w-5 h-5 ms-3')
                    </button>
                    <div id="filterDropdown" class="z-10 hidden w-96 p-3 bg-white rounded-lg shadow">
                        <form action="#" aria-labelledby="filterDropdownButton">
                            <h6 class="mb-3 text-sm font-medium text-gray-900">Vai trò</h6>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <input id="admin" type="checkbox" value="filter-role-admin"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="admin" class="ml-2 text-sm font-medium text-gray-900">Quản trị
                                        viên</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="client" type="checkbox" value="filter-role-client"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="client" class="ml-2 text-sm font-medium text-gray-900">Khách hàng</label>
                                </li>
                            </ul>
                            <h6 class="my-3 text-sm font-medium text-gray-900">Giới tính</h6>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <input id="male" type="checkbox" value="filter-gender-male"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="male" class="ml-2 text-sm font-medium text-gray-900">Nam</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="female" type="checkbox" value="filter-gender-female"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="female" class="ml-2 text-sm font-medium text-gray-900">Nữ</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="other" type="checkbox" value="filter-gender-other"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="other" class="ml-2 text-sm font-medium text-gray-900">Khac</label>
                                </li>
                            </ul>
                            <h6 class="my-3 text-sm font-medium text-gray-900">Trạng thái</h6>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <input id="active" type="checkbox" value="filter-status-active"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="active" class="ml-2 text-sm font-medium text-gray-900">Hoạt động</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="inactive" type="checkbox" value="filter-status-inactive"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="inactive" class="ml-2 text-sm font-medium text-gray-900">Khóa</label>
                                </li>
                            </ul>
                            <h6 class="my-3 text-sm font-medium text-gray-900">Ngày sinh</h6>
                            <div class="flex items-center">
                                <div>
                                    <input name="filter-birthday-start" type="date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                        placeholder="mm/dd/yyyy">
                                </div>
                                <span class="mx-4 text-gray-500">-</span>
                                <div>
                                    <input name="filter-birthday-end" type="date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                        placeholder="mm/dd/yyyy">
                                </div>
                            </div>
                            <h6 class="my-3 text-sm font-medium text-gray-900">Ngày tham gia</h6>
                            <div class="flex items-center">
                                <div>
                                    <input name="filter-created-start" type="date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                        placeholder="mm/dd/yyyy">
                                </div>
                                <span class="mx-4 text-gray-500">-</span>
                                <div>
                                    <input name="filter-created-end" type="date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                        placeholder="mm/dd/yyyy">
                                </div>
                            </div>

                            <button type="submit" class="button-red w-full mt-5">
                                Lọc
                            </button>
                        </form>
                    </div>
                </div>
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
                                            <a class="block px-4 py-2 hover:bg-gray-100" data-modal-target="deleteBanner-modal-{{ $item->id }}" data-modal-toggle="deleteBanner-modal-{{ $item->id }}" href="#">Xoá</a>
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
