@extends('layouts.admin')
@section('title', 'Tài khoản')
@section('content')
    {{ Breadcrumbs::render('admin.users.index') }}
    <x-toast-notification />
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h5>
                    <span class="text-gray-500">Tổng số tài khoản:</span>
                    <span class="">{{ count($users) }}</span>
                </h5>
                <h5>
                    <span class="text-gray-500">Tài khoản hoạt động:</span>
                    <span class="">
                        @php
                            $active = 0;
                            foreach ($users as $user) {
                                $user->status == 1 ? $active++ : '';
                            }
                            echo $active;
                        @endphp
                    </span>
                </h5>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <a href="{{ route('admin.users.create') }}" class="button-blue">
                    @svg('tabler-plus', 'w-5 h-5 mr-2')
                    Thêm tài khoản
                </a>
                <button type="button"
                    class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0">
                    @svg('tabler-file-export', 'w-4 h-4 mr-2')
                    Export
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">Tài khoản</th>
                        <th scope="col" class="px-4 py-3">Họ và tên</th>
                        <th scope="col" class="px-4 py-3">Số điện thoại</th>
                        <th scope="col" class="px-4 py-3">Vai trò </th>
                        <th scope="col" class="px-4 py-3">Trạng thái</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="flex items-center px-4 py-2 text-gray-900 whitespace-nowrap ">
                                <a href="{{ route('admin.users.show', $user) }}">
                                    <img loading="lazy" src="{{ asset('storage/uploads/avatars/' . $user->avatar) }}" alt="Avatar"
                                        class="w-auto h-8 mr-3 rounded">
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
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
