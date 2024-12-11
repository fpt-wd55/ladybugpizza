@extends('layouts.admin')
@section('title', 'Danh mục')
@section('content')
    {{ Breadcrumbs::render('admin.categories.index') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h2 class="font-medium text-gray-700 text-base">
                    Danh mục
                </h2>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3 p-4">
                <a href="{{ route('admin.categories.create') }}"
                    class="flex items-center justify-center px-4 py-2 text-sm text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-0">
                    @svg('tabler-plus', 'w-5 h-5 mr-2')
                    Thêm danh mục
                </a>
                <a href="{{ route('admin.trash.listcate') }}"
                    class="flex items-center justify-center px-4 py-2 text-sm text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-0">
                    @svg('tabler-trash', 'w-5 h-5 mr-2')
                    Thùng rác
                </a>
                <a href="{{ route('admin.categories.export') }}"
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
                    <form method="POST" action="{{ route('admin.categories.bulkAction') }}">
                        @csrf
                        <input type="hidden" name="selected_ids" id="selectedIds" value="">
                        <div id="actionButtons" class="hidden">
                            <button type="submit" name="action" value="delete" class="button-red me-2">Xóa</button>
                            <h2 class="font-medium text-gray-700 text-base italic items-center flex" id="selectedItems">
                            </h2>
                        </div>
                    </form>
                </div>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <form class="flex w-full md:w-40 lg:w-64" action="{{ route('admin.categories.search') }}">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            @svg('tabler-search', 'w-5 h-5 text-gray-400')
                        </div>
                        <input type="text" name="search" class="input ps-10" placeholder="Tìm kiếm..." />
                    </div>
                </form>
                <div class="flex items-center w-full md:w-auto">
                    <button data-modal-target="filterDropdown" data-modal-toggle="filterDropdown"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                        type="button">
                        @svg('tabler-filter-filled', 'w-5 h-5 me-2')
                        Bộ lọc
                    </button>
                    <form action="{{ route('admin.categories.filter') }}" method="get" id="filterDropdown" tabindex="-1"
                        aria-hidden="true"
                        class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full">
                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow">
                                <!-- Modal header -->
                                <div class="flex items-start justify-between px-6 py-4 rounded-t">
                                    <h3 class="text-lg font-semibold text-gray-500">
                                        Bộ lọc
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                        data-modal-toggle="filterDropdown">
                                        @svg('tabler-x', 'w-5 h-5')
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="px-4 md:px-6">
                                    <h6 class="my-3 text-sm font-medium text-gray-900">Trạng thái</h6>
                                    <ul class="space-y-2 text-sm">
                                        <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                            <li class="flex items-center">
                                                <input id="active" type="checkbox" name="filter_status[]" value="1"
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                                    @if (in_array(1, request()->input('filter_status', []))) checked @endif>
                                                <label for="active" class="ml-2 text-sm font-medium text-gray-900">Hoạt
                                                    động</label>
                                            </li>
                                            <li class="flex items-center">
                                                <input id="inactive" type="checkbox" name="filter_status[]" value="2"
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                                    @if (in_array(2, request()->input('filter_status', []))) checked @endif>
                                                <label for="inactive"
                                                    class="ml-2 text-sm font-medium text-gray-900">Khóa</label>
                                            </li>
                                        </div>
                                    </ul>
                                </div>

                                <!-- Modal footer -->
                                <div class="flex items-center p-6 space-x-4 rounded-b">
                                    <button type="submit" class="button-red">
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
            <table class="w-full text-sm text-left ">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="table-checkbox-all" type="checkbox"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3">Hình ảnh</th>
                        <th scope="col" class="px-4 py-3">Tên danh mục</th>
                        <th scope="col" class="px-4 py-3">Trạng thái</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- item --}}
                    @forelse ($category as $key => $item)
                        <tr class="border-b">
                            <td class="w-4 px-4 py-3">
                                <div class="flex items-center">
                                    <input id="table-item-checkbox-{{ $item->id }}" type="checkbox"
                                        value="{{ $item->id }}" onclick="event.stopPropagation()"
                                        class="table-item-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                </div>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">
                                <a class="shrink-0" data-fslightbox="gallery"
                                    href="{{ asset('storage/uploads/categories/' . $item->image) }}">
                                    <img loading="lazy" src="{{ asset('storage/uploads/categories/' . $item->image) }}"
                                        class="img-sm img-circle object-cover">
                                </a>
                            </td>
                            <td class="px-4 py-3">{{ $item->name }}</td>
                            <td class="px-4 py-3">

                                <div class="flex items-center">
                                    <div
                                        class="inline-block indicator {{ $item->status == 1 ? 'bg-green-700' : 'bg-red-700' }}">
                                    </div>
                                    {{ $item->status == 1 ? 'Hoạt động' : 'Khóa' }}
                                </div>

                            </td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="{{ $item->name }}-dropdown-button"
                                    data-dropdown-toggle="{{ $item->name }}-dropdown"
                                    class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                    type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div id="{{ $item->name }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700"
                                        aria-labelledby="{{ $item->name }}-dropdown-button">

                                        <li>
                                            <a href="{{ route('admin.categories.edit', $item) }}"
                                                class="block py-2 px-4 hover:bg-gray-100">Cập nhật</a>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <a href="#" data-modal-target="delete-modal-{{ $item->id }}"
                                            data-modal-toggle="delete-modal-{{ $item->id }}"
                                            class="cursor-pointer block py-2 px-4 text-sm text-red-500 hover:bg-gray-100">Xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{-- start modal --}}
                        <div id="delete-modal-{{ $item->id }}" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="delete-modal-{{ $item->id }}">
                                        @svg('tabler-x', 'w-4 h-4')
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <div class="flex justify-center">
                                            @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                        </div>
                                        <h3 class="mb-5 font-normal">Bạn có muốn xóa Danh mục này không?</h3>

                                        <form action="{{ route('admin.categories.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Xóa
                                            </button>
                                        </form>

                                        <button data-modal-hide="delete-modal-{{ $item->id }}" type="button"
                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Không,
                                            trở lại</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal --}}
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-base">
                                <div
                                    class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
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
                {{ $category->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        tableCheckboxItem('table-checkbox-all', 'table-item-checkbox');
    </script>
@endsection
