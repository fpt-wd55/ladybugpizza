@extends('layouts.admin')
@section('title', 'Danh mục | Thùng rác')
@section('content')
    {{ Breadcrumbs::render('admin.trash.listcate') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h2 class="font-medium text-gray-700 text-base">
                    Thùng rác
                </h2>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <a href="{{ route('admin.categories.index') }}">
                    <button type="button" class="button-gray">Quay Lại</button>
                </a>
            </div>
        </div>
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4 border-t">
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <div class="flex items-center space-x-3 w-full md:w-full">
                    <form method="POST" action="#">
                        @csrf
                        <input type="hidden" name="selected_ids" id="selectedIds" value="">
                        <div id="actionButtons" class="hidden">
                            <button type="submit" name="action" value="delete" class="button-red me-2">Xóa</button>
                            <button type="submit" name="action" value="deactivate" class="button-gray me-2">Hủy kích
                                hoạt</button>
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
                <div class="flex items-center space-x-3 w-full md:w-auto">
                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                        type="button">
                        @svg('tabler-filter-filled', 'w-5 h-5 me-2')
                        Bộ lọc
                        @svg('tabler-chevron-down', 'w-5 h-5 ms-3')
                    </button>
                    <div id="filterDropdown" class="z-10 hidden w-96 p-3 bg-white rounded-lg shadow">
                        <form action="{{ route('admin.categories.filter') }}" aria-labelledby="filterDropdownButton">
                            <h6 class="my-3 text-sm font-medium text-gray-900">Trạng thái</h6>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <input id="active" type="checkbox" name="filter_status[]" value="1"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                        @if (in_array(1, request()->input('filter_status', []))) checked @endif>
                                    <label for="active" class="ml-2 text-sm font-medium text-gray-900">Hoạt động</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="inactive" type="checkbox" name="filter_status[]" value="2"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                        @if (in_array(2, request()->input('filter_status', []))) checked @endif>
                                    <label for="inactive" class="ml-2 text-sm font-medium text-gray-900">Khóa</label>
                                </li>
                            </ul>

                            <button type="submit" class="button-red me-2 w-full mt-5">
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
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="table-checkbox-all" type="checkbox"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                            </div>                  
                        </th>
                        <th scope="col" class="px-4 py-3">Tên danh mục</th>
                        <th scope="col" class="px-4 py-3">Slug</th>
                        <th scope="col" class="px-4 py-3">Trạng thái</th>
                        <th scope="col" class="px-4 py-3 ">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- item Category --}}
                    @forelse ($deletedCategories as $key => $item)
                        <tr class="border-b">
                            <td class="w-4 px-4 py-3">
                                <div class="flex items-center">
                                    <input id="table-item-checkbox-{{ $item->id }}" type="checkbox"
                                        value="{{ $item->id }}" onclick="event.stopPropagation()"
                                        class="table-item-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                </div>
                            </td>
                            <td class="px-4 py-3">{{ $item->name }}</td>
                            <td class="px-4 py-3">{{ $item->slug }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <div
                                        class="inline-block indicator {{ $item->status == 1 ? 'bg-green-700' : 'bg-red-700' }}">
                                    </div>
                                    {{ $item->status == 1 ? 'Hoạt động' : 'Khóa' }}
                                </div>
                            </td>
                            <td class="pt-4 py-3 px-4 flex items-center mt-0 ">
                                <a href="#" data-modal-target="restore-modal-{{ $item->id }}"
                                    data-modal-toggle="restore-modal-{{ $item->id }}"
                                    class="cursor-pointer block px-1 text-sm  text-gray-500 hover:text-green-500 "
                                    title="Restore">

                                    @svg('tabler-restore')
                                </a>


                                <a href="#" data-modal-target="delete-modal-{{ $item->id }}"
                                    data-modal-toggle="delete-modal-{{ $item->id }}"
                                    class="cursor-pointer block px-1 text-sm  text-gray-500 hover:text-red-500 "
                                    title="Delete">
                                    @svg('tabler-trash-x-filled')
                                </a>


                            </td>
                        </tr>
                        {{-- start modal restore --}}
                        <div id="restore-modal-{{ $item->id }}" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="restore-modal-{{ $item->id }}">
                                        @svg('tabler-x', 'w-4 h-4')
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <div class="flex justify-center">
                                            @svg('tabler-arrow-back-up-double', 'w-12 h-12 text-green-600 text-center mb-2 ')
                                        </div>
                                        <h3 class="mb-5 font-normal">Bạn có muốn khôi phục Danh mục này không?</h3>

                                        <form action="{{ route('admin.trash.cateRestore', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Có
                                            </button>
                                        </form>

                                        <button data-modal-hide="restore-modal-{{ $item->id }}" type="button"
                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Không,
                                            trở lại</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal restore --}}

                        {{-- start modal delete --}}
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
                                        <h3 class="mb-5 font-normal">Bạn có muốn xóa vĩnh viễn Danh mục này không?</h3>

                                        <form action="{{ route('admin.trash.cateDelete', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Xóa
                                            </button>
                                        </form>

                                        <button data-modal-hide="delete-modal-{{ $item->id }}" type="button"
                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Không,
                                            trở lạo</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal delete --}}
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-base ">
                                <div
                                    class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
                                    @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                    <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    {{-- end item Category --}}
                </tbody>
            </table>
            <div class="p-4">
                {{ $deletedCategories->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        tableCheckboxItem('table-checkbox-all', 'table-item-checkbox');
    </script>
@endsection
