@extends('layouts.admin')
@section('title', 'Tài khoản')
@section('content')
    {{ Breadcrumbs::render('admin.users.index') }}
    <div class="relative mt-5 min-h-screen overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="flex flex-col space-y-3 px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
            <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                <h2 class="me-7 text-base font-medium text-gray-700">
                    Tài khoản
                </h2>
            </div>
            <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                <a class="button-blue" href="{{ route('admin.users.create') }}">
                    @svg('tabler-plus', 'w-5 h-5 mr-2')
                    Thêm tài khoản
                </a>
                <a class="button-light" href="{{ route('admin.users.export') }}">
                    @svg('tabler-file-export', 'w-4 h-4 mr-2')
                    Xuất dữ liệu
                </a>
            </div>
        </div>
        <div class="flex flex-col space-y-3 border-t px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
            <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                <div class="flex w-full items-center space-x-3 md:w-full">
                </div>
            </div>
            <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                <form action="{{ route('admin.users.search') }}" class="flex w-full md:w-40 lg:w-64">
                    <div class="relative w-full">
                        <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                            @svg('tabler-search', 'w-5 h-5 text-gray-400')
                        </div>
                        <input class="input ps-10" name="search" placeholder="Tìm kiếm..." type="text" value="{{ old('search', request('search')) }}" />
                    </div>
                </form>

                <div class="flex w-full items-center md:w-auto">
                    <button class="flex w-full items-center justify-center button-light" data-modal-target="filterDropdown" data-modal-toggle="filterDropdown" type="button">
                        @svg('tabler-filter-filled', 'w-5 h-5 me-2')
                        Bộ lọc
                    </button>
                    <form action="{{ route('admin.users.filter') }}" aria-hidden="true" class="fixed inset-0 z-50 hidden h-modal w-full overflow-y-auto overflow-x-hidden p-4 md:h-full" id="filterDropdown" method="get" tabindex="-1">
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
                                    <h6 class="mb-3 text-sm font-medium text-gray-900">Vai trò</h6>
                                    <ul class="space-y-2 text-sm">
                                        <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                            @foreach ($roles as $role)
                                                <li class="flex items-center">
                                                    <input @if (in_array($role->id, request()->input('filter_role', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="admin" name="filter_role[]" type="checkbox" value="{{ $role->id }}">
                                                    <label class="ml-2 text-sm font-medium text-gray-900" for="admin">{{ $role->name }}</label>
                                                </li>
                                            @endforeach
                                        </div>
                                    </ul>
                                    <h6 class="my-3 text-sm font-medium text-gray-900">Giới tính</h6>
                                    <ul class="space-y-2 text-sm">
                                        <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                            <li class="flex items-center">
                                                <input @if (in_array(1, request()->input('filter_gender', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="male" name="filter_gender[]" type="checkbox" value="1">
                                                <label class="ml-2 text-sm font-medium text-gray-900" for="male">Nam</label>
                                            </li>
                                            <li class="flex items-center">
                                                <input @if (in_array(2, request()->input('filter_gender', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="female" name="filter_gender[]" type="checkbox" value="2">
                                                <label class="ml-2 text-sm font-medium text-gray-900" for="female">Nữ</label>
                                            </li>
                                            <li class="flex items-center">
                                                <input @if (in_array(3, request()->input('filter_gender', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="other" name="filter_gender[]" type="checkbox" value="3">
                                                <label class="ml-2 text-sm font-medium text-gray-900" for="other">Khác</label>
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
                                    <h6 class="my-3 text-sm font-medium text-gray-900">Ngày sinh</h6>
                                    <div class="flex items-center">
                                        <div>
                                            <input class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-3 text-sm text-gray-900 focus:ring-0" name="filter_birthday_start" placeholder="mm/dd/yyyy" type="date" value="{{ old('filter_birthday_start', request()->input('filter_birthday_start')) }}">
                                        </div>
                                        <span class="mx-4 text-gray-500">-</span>
                                        <div>
                                            <input class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-3 text-sm text-gray-900 focus:ring-0" name="filter_birthday_end" placeholder="mm/dd/yyyy" type="date" value="{{ old('filter_birthday_end', request()->input('filter_birthday_end')) }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="flex items-center space-x-4 rounded-b p-6">
                                    <button class="button-red" type="submit">
                                        Lọc tài khoản
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 uppercase text-gray-700">
                    <tr>
                        <th class="px-4 py-3" scope="col">
                            <div class="flex items-center">
                                Tài khoản
                                <a href="#">@svg('tabler-caret-up-down-filled', 'w-3 h-3 ms-1')</a>
                            </div>
                        </th>
                        <th class="px-4 py-3" scope="col">
                            <div class="flex items-center">
                                Họ và tên
                                <a href="#">@svg('tabler-caret-up-down-filled', 'w-3 h-3 ms-1')</a>
                            </div>
                        </th>
                        <th class="px-4 py-3" scope="col">Số điện thoại</th>
                        <th class="px-4 py-3" scope="col">
                            <div class="flex items-center">
                                Vai trò
                                <a href="#">@svg('tabler-caret-up-down-filled', 'w-3 h-3 ms-1')</a>
                            </div>
                        </th>
                        <th class="px-4 py-3" scope="col">
                            <div class="flex items-center">
                                Trạng thái
                                <a href="#">@svg('tabler-caret-up-down-filled', 'w-3 h-3 ms-1')</a>
                            </div>
                        </th>
                        <th class="px-4 py-3" scope="col">
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="flex items-center whitespace-nowrap px-4 py-2 text-gray-900">
                                <a class="shrink-0" data-fslightbox="gallery" href="{{ $user->avatar() }}">
                                    <img alt="Avatar" class="mr-3 h-8 w-8 rounded object-cover" loading="lazy" src="{{ $user->avatar() }}">
                                </a>
                                <a class="hover:text-red-600" href="{{ route('admin.users.show', $user) }}">
                                    <div class="grid grid-flow-row">
                                        <span class="text-sm">{{ $user->username }}</span>
                                        <span class="text-sm text-gray-500">{{ $user->email }}</span>
                                    </div>
                                </a>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-900">{{ $user->fullname }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-900">{{ $user->phone }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                <span class="{{ $user->role_id == 2 ? 'text-blue-500 bg-blue-100' : 'text-red-500 bg-yellow-100' }} me-2 mt-1.5 inline-flex shrink-0 items-center rounded px-2.5 py-0.5 text-xs font-medium">
                                    {{ $user->role_id == 2 ? 'Khách hàng' : 'Quản trị viên' }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                <div class="flex items-center">
                                    <div class="indicator {{ $user->status == 1 ? 'bg-green-700' : 'bg-red-700' }} inline-block">
                                    </div>
                                    {{ $user->status == 1 ? 'Hoạt động' : 'Khóa' }}
                                </div>
                            </td>
                            <td class="flex items-center justify-end px-4 py-3">
                                <button class="inline-flex items-center rounded-lg p-0.5 text-center text-sm text-gray-500 hover:text-gray-800 focus:outline-none" data-dropdown-toggle="{{ $user->username }}-dropdown" id="{{ $user->username }}" type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow" id="{{ $user->username }}-dropdown">
                                    <ul aria-labelledby="{{ $user->username }}" class="py-1 text-sm text-gray-700">
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('admin.users.show', $user) }}">Chi tiết</a>
                                        </li>
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('admin.users.edit', $user) }}">Cập nhật</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td class="py-4 text-center text-base" colspan="6">
                            <div class="flex h-80 w-full flex-col items-center justify-center rounded-lg bg-white p-6">
                                @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                <p class="mt-4 text-sm text-gray-500">Dữ liệu trống</p>
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
