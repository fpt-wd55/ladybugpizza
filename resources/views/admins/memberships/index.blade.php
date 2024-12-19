@extends('layouts.admin')
@section('title', 'Điểm thành viên')
@section('content')
{{ Breadcrumbs::render('admin.memberships.index') }}
<div class="relative mt-5 overflow-hidden bg-white shadow sm:rounded-lg">
    <div class="flex flex-col space-y-3 px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
        <div class="flex flex-1 items-center space-x-4">
            <h2 class="text-base font-medium text-gray-700">
                Điểm thành viên
            </h2>
        </div>
        <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
            <a class="button-light" href="{{ route('admin.memberships.export') }}">
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
            <form action="{{ route('admin.memberships.search') }}" class="flex w-full md:w-40 lg:w-64">
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
                <form action="{{ route('admin.memberships.filter') }}" aria-hidden="true" class="fixed inset-0 z-50 hidden h-modal w-full overflow-y-auto overflow-x-hidden p-4 md:h-full" id="filterDropdown" method="get" tabindex="-1">
                    <div class="relative h-full w-full max-w-2xl md:h-auto">
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
                                <h6 class="my-3 text-sm font-medium text-gray-900">Thứ hạng</h6>
                                <ul class="space-y-2 text-sm">
                                    <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                        @foreach ($ranks as $rank)
                                        <li class="flex items-center">
                                            <input @if (in_array($rank->id, request()->input('filter_rank', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" name="filter_rank[]" type="checkbox" value="{{ $rank->id }}">
                                            <label class="ml-2 text-sm font-medium text-gray-900" for="admin">{{ $rank->name }}</label>
                                        </li>
                                        @endforeach
                                    </div>
                                </ul>
                            </div>

                            <!-- Modal footer -->
                            <div class="flex items-center space-x-4 rounded-b p-6">
                                <button class="button-red" type="submit">
                                    Lọc dữ liệu
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
                    <th class="text-xs md:px-0 md:py-0 md:text-sm lg:px-4 lg:py-3" scope="col">Tài khoản</th>
                    <th class="px-0 py-0 text-xs md:text-sm lg:py-3" scope="col">Họ và tên</th>
                    <th class="text-center text-xs md:px-0 md:py-0 md:text-sm lg:px-4 lg:py-3" scope="col">Thứ hạng</th>
                    <th class="text-xs md:px-0 md:py-0 md:text-sm lg:px-4 lg:py-3" scope="col">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- star item --}}
                @forelse ($memberships as $membership)
                <tr class="border-b hover:bg-gray-100">
                    <td class="mt-3 flex items-center whitespace-nowrap px-4 py-2 text-gray-900">
                        <a class="shrink-0" href="{{ route('admin.memberships.edit', $membership) }}">
                            <img class="img-circle img-sm mr-3 rounded border-2 object-cover hover:border-[#D30A0A] lg:h-11 lg:w-11" loading="lazy" src="{{ asset('storage/uploads/avatars/' . $membership->user->avatar) }}">
                        </a>
                        <a class="hover:text-[#D30A0A]" href="{{ route('admin.memberships.edit', $membership) }}">
                            <div class="grid grid-flow-row">
                                <span class="md:text-xs lg:text-sm">{{ $membership->user->username }}</span>
                                <span class="text-gray-500">{{ $membership->user->email }}</span>
                            </div>
                        </a>
                    </td>
                    <td class="whitespace-nowrap text-gray-900">{{ $membership->user->fullname }}</td>
                    <td class="whitespace-nowrap text-gray-900 lg:px-4 lg:py-2">
                        <div class="flex flex-col items-center">
                            <img class="img-circle h-8 w-8 object-contain" loading="lazy" src="{{ asset('storage/uploads/ranks/' . $membership->rank->icon) }}">
                            <p class="{{ $membership->rank->color }} text-xs uppercase hidden md:inline-block md:font-medium lg:font-semibold">
                                {{ $membership->rank->name }}
                            </p>
                        </div>
                    </td>
                    <td class="items-center lg:px-4 lg:py-3">
                        <button class="hidden items-center rounded-lg p-0.5 text-center text-sm text-gray-500 hover:text-gray-800 focus:outline-none md:block" data-dropdown-toggle="{{ $membership->id }}-dropdown" id="{{ $membership->id }}" type="button">
                            @svg('tabler-dots', 'w-5 h-5')
                        </button>
                        <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow" id="{{ $membership->id }}-dropdown">
                            <ul aria-labelledby="{{ $membership->id }}" class="py-1 text-sm text-gray-700">
                                <li>
                                    <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('admin.memberships.edit', $membership) }}">Chi tiết</a>
                                </li>

                            </ul>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="py-4 text-center text-base" colspan="5">
                        <div class="flex h-80 w-full flex-col items-center justify-center rounded-lg bg-white p-6">
                            @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                            <p class="mt-4 text-sm text-gray-500">Dữ liệu trống</p>
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