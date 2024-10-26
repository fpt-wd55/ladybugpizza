@extends('layouts.admin')
@section('title', 'Tài khoản')
@section('content')
    {{ Breadcrumbs::render('admin.users.index') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <h2 class="font-medium text-gray-700 text-base me-7">
                    Tài khoản
                </h2>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <a href="{{ route('admin.users.create') }}" class="button-blue">
                    @svg('tabler-plus', 'w-5 h-5 mr-2')
                    Thêm tài khoản
                </a>
                <a href="{{ route('admin.users.export') }}"
                    class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0">
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
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Mass
                                    Edit</a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Delete
                                all</a>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <form class="flex w-full md:w-40 lg:w-64" action="{{ route('admin.dashboard') }}">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            @svg('tabler-search', 'w-5 h-5 text-gray-400')
                        </div>
                        <input type="text" id="simple-search" class="input ps-10" placeholder="Tìm kiếm..." />
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
                    <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                        <h6 class="mb-3 text-sm font-medium text-gray-900">Choose brand</h6>
                        <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                            <li class="flex items-center">
                                <input id="apple" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                <label for="apple" class="ml-2 text-sm font-medium text-gray-900">Apple
                                    (56)</label>
                            </li>
                            <li class="flex items-center">
                                <input id="fitbit" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900">Microsoft
                                    (16)</label>
                            </li>
                            <li class="flex items-center">
                                <input id="razor" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                <label for="razor" class="ml-2 text-sm font-medium text-gray-900">Razor
                                    (49)</label>
                            </li>
                            <li class="flex items-center">
                                <input id="nikon" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                <label for="nikon" class="ml-2 text-sm font-medium text-gray-900">Nikon
                                    (12)</label>
                            </li>
                            <li class="flex items-center">
                                <input id="benq" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                <label for="benq" class="ml-2 text-sm font-medium text-gray-900">BenQ
                                    (74)</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="table-checkbox-all" type="checkbox"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3">Tài khoản</th>
                        <th scope="col" class="px-4 py-3">Họ và tên</th>
                        <th scope="col" class="px-4 py-3">Số điện thoại</th>
                        <th scope="col" class="px-4 py-3">Vai trò </th>
                        <th scope="col" class="px-4 py-3">Trạng thái</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="w-4 px-4 py-3">
                                <div class="flex items-center">
                                    <input id="table-item-checkbox-{{ $user->id }}" type="checkbox"
                                        onclick="event.stopPropagation()"
                                        class="table-item-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                </div>
                            </td>
                            <td class="flex items-center px-4 py-2 text-gray-900 whitespace-nowrap">
                                <a class="shrink-0" data-fslightbox="gallery" href="{{ $user->avatar() }}">
                                    <img loading="lazy" src="{{ $user->avatar() }}" alt="Avatar"
                                        class="w-8 h-8 mr-3 rounded">
                                </a>
                                <a href="{{ route('admin.users.show', $user) }}">
                                    <div class="grid grid-flow-row">
                                        <span class="text-sm">{{ $user->username }}</span>
                                        <span class="text-sm text-gray-500">{{ $user->email }}</span>
                                    </div>
                                </a>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">{{ $user->fullname }}</td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">{{ $user->phone }}</td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">
                                <span
                                    class="me-2 mt-1.5 {{ $user->role_id == 2 ? 'text-blue-500 bg-blue-100' : 'text-red-500 bg-yellow-100' }} inline-flex shrink-0 items-center rounded px-2.5 py-0.5 text-xs font-medium">
                                    {{ $user->role_id == 2 ? 'Khách hàng' : 'Quản trị viên' }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">
                                <div class="flex items-center">
                                    <div
                                        class="inline-block indicator {{ $user->status == 1 ? 'bg-green-700' : 'bg-red-700' }}">
                                    </div>
                                    {{ $user->status == 1 ? 'Hoạt động' : 'Khóa' }}
                                </div>
                            </td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="{{ $user->username }}" data-dropdown-toggle="{{ $user->username }}-dropdown"
                                    class="inline-flex items-center p-0.5 text-sm text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                    type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div id="{{ $user->username }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="{{ $user->username }}">
                                        <li>
                                            <a href="{{ route('admin.users.show', $user) }}"
                                                class="block py-2 px-4 hover:bg-gray-100">Chi tiết</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="block py-2 px-4 hover:bg-gray-100">Cập nhật</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td colspan="6" class="text-center py-4 text-base">
                            <div class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
                                @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4">
                {{ $users->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        tableCheckboxItem('table-checkbox-all', 'table-item-checkbox');
    </script>
@endsection
