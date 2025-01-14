@extends('layouts.admin')
@section('title', 'Trang')

@section('content')
    {{ Breadcrumbs::render('admin.pages.index') }}
    <div class="relative mt-5 overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="overflow-x-auto">
            <div class="flex flex-col space-y-3 px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
                <div class="flex flex-1 items-center space-x-4">
                    <h2 class="text-base font-medium text-gray-700">
                        Danh sách trang
                    </h2>
                </div>
                <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                    <form action="{{ route('admin.page.search') }}" class="flex w-full md:w-40 lg:w-64">
                        <div class="relative w-full">
                            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                                @svg('tabler-search', 'w-5 h-5 text-gray-400')
                            </div>
                            <input class="input ps-10" name="search" placeholder="Tìm kiếm..." type="text" value="{{ old('search', request('search')) }}"/>
                        </div>
                    </form>
                    <a class="button-blue" href="{{ route('admin.pages.create') }}">
                        @svg('tabler-plus', 'w-5 h-5 mr-2')
                        Thêm trang
                    </a>
                    <a class="button-red" href="{{ route('admin.trash.pages') }}">
                        @svg('tabler-trash', 'w-5 h-5 mr-2')
                        Thùng rác
                    </a>
                    <a class="button-light" href="{{ route('admin.page.export') }}">
                        @svg('tabler-file-export', 'w-4 h-4 mr-2')
                        Xuất dữ liệu
                    </a>
                </div>
            </div>
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 uppercase text-gray-700">
                    <tr>
                        <th class="p-4" scope="col">
                            <div class="flex items-center">
                                <input class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="table-checkbox-all" type="checkbox">
                            </div>
                        </th>
                        <th class="px-4 py-3" scope="col">Trang</th>
                        <th class="px-4 py-3" scope="col">Đường dẫn</th>
                        <th class="px-4 py-3" scope="col">Trạng thái</th>
                        <th class="px-4 py-3" scope="col">Loại</th>
                        <th class="px-4 py-3" scope="col">
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $page)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="w-4 px-4 py-3">
                                <div class="flex items-center">
                                    <input class="table-item-checkbox text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="table-item-checkbox-{{ $page->id }}" onclick="event.stopPropagation()" type="checkbox" value="{{ $page->id }}">
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 uppercase text-gray-900">
                                <a class="font-medium hover:text-red-600" href="{{ route('admin.pages.edit', $page->id) }}">{{ $page->title }}</a>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-900"> {{ $page->slug }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                <div class="flex items-center">
                                    <div class="indicator {{ $page->status == 1 ? 'bg-green-700' : 'bg-red-700' }} inline-block">
                                    </div>
                                    {{ $page->status == 1 ? 'Hoạt động' : 'Khóa' }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                <span class="{{ $page->type == 1 ? 'badge-default' : 'badge-gray' }}">{{ $page->type == 1 ? 'Mặc định' : 'Khác' }}</span>
                            </td>
                            <td class="flex items-center justify-end px-4 py-3">
                                <button class="inline-flex items-center rounded-lg p-0.5 text-center text-sm text-gray-500 hover:text-gray-800 focus:outline-none" data-dropdown-toggle="{{ $page->id }}-dropdown" id="{{ $page->id }}" type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow" id="{{ $page->id }}-dropdown">
                                    <ul aria-labelledby="{{ $page->id }}" class="py-1 text-sm text-gray-700">
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('client.dynamic-page', $page->slug) }}" target="_blank">Xem trước</a>
                                        </li>
                                        <li>
                                            <a class="block cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('admin.pages.edit', $page->id) }}">Cập
                                                nhật</a>
                                        </li>
                                        @if ($page->type == 2)
                                            <li>
                                                <a class="block cursor-pointer px-4 py-2 text-sm text-red-500 hover:bg-gray-100" data-modal-target="delete-modal-{{ $page->id }}" data-modal-toggle="delete-modal-{{ $page->id }}" href="#">Xóa</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        {{-- delete modal --}}
                        @if ($page->type == 2)
                            <div class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0" id="delete-modal-{{ $page->id }}" tabindex="-1">
                                <div class="relative max-h-full w-full max-w-md p-4">
                                    <div class="relative rounded-lg bg-white shadow">
                                        <button class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-hide="delete-modal-{{ $page->id }}" type="button">
                                            @svg('tabler-x', 'w-4 h-4')
                                        </button>
                                        <div class="p-4 text-center md:p-5">
                                            <div class="flex justify-center">
                                                @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                            </div>
                                            <h3 class="mb-5 font-normal">Bạn có muốn xóa trang này không?</h3>
                                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300" type="submit">
                                                    Xóa
                                                </button>
                                            </form>

                                            <button class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100" data-modal-hide="delete-modal-{{ $page->id }}" type="button">Không</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- end delete modal --}}

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
                {{ $pages->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        tableCheckboxItem('table-checkbox-all', 'table-item-checkbox');
        const clipboard = FlowbiteInstances.getInstance('CopyClipboard', 'contact-details');
        const tooltip = FlowbiteInstances.getInstance('Tooltip', 'tooltip-contact-details');
    </script>
@endsection
