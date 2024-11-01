@extends('layouts.admin')
@section('title', 'Điểm thành viên')
@section('content')
    {{ Breadcrumbs::render('admin.memberships.index') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h2 class="font-medium text-gray-700 text-base">
                    Điểm thành viên
                </h2>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <a href="{{ route('admin.memberships.export') }}"
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
                <form class="flex w-full md:w-40 lg:w-64" action="{{ route('admin.memberships.search') }}">
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
                        <form action="{{ route('admin.memberships.filter') }}" aria-labelledby="filterDropdownButton">
                            <h6 class="mb-3 text-sm font-medium text-gray-900">Thứ hạng</h6>
                            <ul class="space-y-2 text-sm">
                                @foreach ($ranks as $rank)
                                    <li class="flex items-center">
                                        <input type="checkbox" name="filter_rank[]" value="{{ $rank->min_point }}"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                            @if (in_array($rank->min_point, request()->input('filter_rank', []))) checked @endif>
                                        <label for="admin"
                                            class="ml-2 text-sm font-medium text-gray-900">{{ $rank->name }}</label>
                                    </li>
                                @endforeach
                            </ul>

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
                        <th scope="col" class="md:px-0 md:py-0 lg:px-4 lg:py-3 text-xs md:text-sm">Tài khoản</th>
                        <th scope="col" class="px-0 py-0 lg:py-3 text-xs md:text-sm">Họ và tên</th>
                        <th scope="col" class="md:px-0 md:py-0 lg:px-4 lg:py-3 text-center text-xs md:text-sm">Thứ hạng
                        </th>
                        <th scope="col" class="md:px-0 md:py-0 lg:px-4 lg:py-3 text-xs md:text-sm">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- star item --}}
                    @forelse ($memberships as $membership)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="flex items-center px-4 py-2 text-gray-900 whitespace-nowrap mt-3">
                                <a class="shrink-0" href="{{ route('admin.memberships.edit', $membership) }}">
                                    <img loading="lazy"
                                        src="{{ asset('storage/uploads/avatars/' . $membership->user->avatar) }}"
                                        class="img-circle img-sm lg:w-11 lg:h-11 mr-3 rounded border-2 hover:border-[#D30A0A] object-cover">
                                </a>
                                <a href="{{ route('admin.memberships.edit', $membership) }}" class="hover:text-[#D30A0A]">
                                    <div class="grid grid-flow-row">
                                        <span class="md:text-xs lg:text-sm">{{ $membership->user->username }}</span>
                                        <span class=" text-gray-500">{{ $membership->user->email }}</span>
                                    </div>
                                </a>
                            </td>
                            <td class="text-gray-900 whitespace-nowrap">{{ $membership->user->fullname }}
                            </td>
                            <td class="lg:px-4 lg:py-2 text-gray-900 whitespace-nowrap ">
                                <div class="flex flex-col items-center ">
                                    <img loading="lazy" src="{{ asset('storage/uploads/ranks/' . $membership->rank_img) }}"
                                        class="img-circle w-7 h-7 object-cover">
                                    <p
                                        class="uppercase text-xs md:text-sm md:font-medium lg:font-semibold {{ $membership->rank_color }}">
                                        {{ $membership->rank_name }}</p>
                                </div>
                            </td>

                            <td class="lg:px-4 lg:py-3 items-center ">
                                <button id="{{ $membership->id }}" data-dropdown-toggle="{{ $membership->id }}-dropdown"
                                    class="items-center p-0.5 text-sm text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none hidden md:block"
                                    type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div id="{{ $membership->id }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="{{ $membership->id }}">
                                        <li>
                                            <a href="{{ route('admin.memberships.edit', $membership) }}"
                                                class="block py-2 px-4 hover:bg-gray-100">Chi tiết</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-base">
                                <div class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
                                    @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                    <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    {{-- end item --}}
                </tbody>
            </table>
            <div class="p-4">
                {{ $memberships->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
