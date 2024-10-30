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
                                @foreach ($roles as $role)
                                    <li class="flex items-center">
                                        <input id="admin" type="checkbox" value="filter-role-{{ $role->id }}"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                        <label for="admin"
                                            class="ml-2 text-sm font-medium text-gray-900">{{ $role->name }}</label>
                                    </li>
                                @endforeach
                            </ul>
                            <h6 class="my-3 text-sm font-medium text-gray-900">Giới tính</h6>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <input id="male" type="checkbox" value="filter-gender-1"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="male" class="ml-2 text-sm font-medium text-gray-900">Nam</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="female" type="checkbox" value="filter-gender-2"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="female" class="ml-2 text-sm font-medium text-gray-900">Nữ</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="other" type="checkbox" value="filter-gender-3"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="other" class="ml-2 text-sm font-medium text-gray-900">Khác</label>
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
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">
                            <div class="flex items-center">
                                Tài khoản
                                <a href="#">@svg('tabler-caret-up-down-filled', 'w-3 h-3 ms-1')</a>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3">
                            <div class="flex items-center">
                                Họ và tên
                                <a href="#">@svg('tabler-caret-up-down-filled', 'w-3 h-3 ms-1')</a>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3">Số điện thoại</th>
                        <th scope="col" class="px-4 py-3">
                            <div class="flex items-center">
                                Vai trò
                                <a href="#">@svg('tabler-caret-up-down-filled', 'w-3 h-3 ms-1')</a>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3">
                            <div class="flex items-center">
                                Trạng thái
                                <a href="#">@svg('tabler-caret-up-down-filled', 'w-3 h-3 ms-1')</a>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="flex items-center px-4 py-2 text-gray-900 whitespace-nowrap">
                                <a class="shrink-0" data-fslightbox="gallery" href="{{ $user->avatar() }}">
                                    <img loading="lazy" src="{{ $user->avatar() }}" alt="Avatar"
                                        class="w-8 h-8 mr-3 rounded object-cover">
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
