@extends('layouts.admin')
@section('title', 'Trang | Thùng rác')

@section('content')
    {{ Breadcrumbs::render('admin.trash-pages') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <div
                class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                <div class="flex items-center flex-1 space-x-4">
                    <h2 class="font-medium text-gray-700 text-base">
                        Thùng rác
                    </h2>
                </div>
                <div
                    class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                    <a href="{{ route('admin.pages.index') }}" class="button-gray">Quay
                        lại</a>
                </div>
            </div>
            <div
                class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4 border-t">
                <div
                    class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                    <div class="flex items-center space-x-3 w-full md:w-full">
                        <form method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="selected_ids" id="selectedIds" value="">
                            <div id="actionButtons" class="hidden">
                                <button type="submit" name="action" value="restore" class="button-green me-2">Khôi
                                    phục</button>
                                <button type="submit" name="action" value="force_delete" class="button-red me-2">Xóa vĩnh
                                    viễn</button>
                                <h2 class="font-medium text-gray-700 text-base italic items-center flex" id="selectedItems">
                                </h2>
                            </div>
                        </form>
                    </div>
                </div>
                <div
                    class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                    <form class="flex w-full md:w-40 lg:w-64" action="{{ route('admin.products.search') }}">
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
                        <form action="#" method="get" id="filterDropdown" tabindex="-1" aria-hidden="true"
                            class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full">
                            <div class="relative w-full h-full max-w-2xl md:h-auto">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                    <!-- Modal header -->
                                    <div class="flex items-start justify-between px-6 py-4 rounded-t">
                                        <h3 class="text-lg font-semibold text-gray-500 dark:text-gray-400">
                                            Bộ lọc
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
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
                                                    <input id="active" type="checkbox" name="filter_status[]"
                                                        value="1"
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                                        @if (in_array(1, request()->input('filter_status', []))) checked @endif>
                                                    <label for="active"
                                                        class="ml-2 text-sm font-medium text-gray-900">Hoạt
                                                        động</label>
                                                </li>
                                                <li class="flex items-center">
                                                    <input id="inactive" type="checkbox" name="filter_status[]"
                                                        value="2"
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                                        @if (in_array(2, request()->input('filter_status', []))) checked @endif>
                                                    <label for="inactive"
                                                        class="ml-2 text-sm font-medium text-gray-900">Khóa</label>
                                                </li>
                                                <li class="flex items-center">
                                                    <input id="active" type="checkbox" name="filter_inventory[]"
                                                        value="1"
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                                        @if (in_array(1, request()->input('filter_inventory', []))) checked @endif>
                                                    <label for="active" class="ml-2 text-sm font-medium text-gray-900">Còn
                                                        hàng</label>
                                                </li>
                                                <li class="flex items-center">
                                                    <input id="inactive" type="checkbox" name="filter_inventory[]"
                                                        value="2"
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                                        @if (in_array(2, request()->input('filter_inventory', []))) checked @endif>
                                                    <label for="inactive" class="ml-2 text-sm font-medium text-gray-900">Hết
                                                        hàng</label>
                                                </li>
                                            </div>
                                        </ul>
                                        <h6 class="my-3 text-sm font-medium text-gray-900">Sản phẩm</h6>
                                        <ul class="space-y-2 text-sm">
                                            <li class="flex items-center">
                                                <input id="is_featured" type="checkbox" name="filter_is_featured"
                                                    value="1"
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                                    @if (request()->input('filter_is_featured') == 1) checked @endif>
                                                <label for="is_featured"
                                                    class="ml-2 text-sm font-medium text-gray-900">Sản
                                                    phẩm
                                                    hot</label>
                                            </li>
                                            <li class="flex items-center">
                                                <input id="product_discount" type="checkbox"
                                                    name="filter_product_discount" value="1"
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                                    @if (request()->input('filter_product_discount') == 1) checked @endif>
                                                <label for="product_discount"
                                                    class="ml-2 text-sm font-medium text-gray-900">Sản phẩm
                                                    khuyến mãi</label>
                                            </li>
                                        </ul>
                                        <h6 class="my-3 text-sm font-medium text-gray-900">Giá</h6>
                                        <div class="flex items-center">
                                            <div>
                                                <input name="filter_price_min" type="number"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                                    placeholder="1.000 đ">
                                            </div>
                                            <span class="mx-4 text-gray-500">-</span>
                                            <div>
                                                <input name="filter_price_max" type="number"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                                    placeholder="100.000.000 đ">
                                            </div>
                                        </div>
                                        <h6 class="my-3 text-sm font-medium text-gray-900">Đánh giá</h6>
                                        <ul class="space-y-2 text-sm">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <li class="flex items-center">
                                                    <input id="active" type="checkbox" name="filter_rating[]"
                                                        value="{{ $i }}"
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                                        @if (in_array(1, request()->input('filter_rating', []))) checked @endif>
                                                    <label for="active"
                                                        class="ml-2 text-sm font-medium text-gray-900 flex items-center gap-1">
                                                        <div class="flex items-center gap-0.3">
                                                            @for ($j = 1; $j <= $i; $j++)
                                                                @svg('tabler-star-filled', 'icon-sm me-1 text-red-500')
                                                            @endfor
                                                            @if ($i < 5)
                                                                @for ($k = 0; $k < 5 - $i; $k++)
                                                                    @svg('tabler-star', 'icon-sm me-1 text-red-500')
                                                                @endfor
                                                            @endif
                                                        </div>
                                                    </label>
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="flex items-center p-6 space-x-4 rounded-b dark:border-gray-600">
                                        <button type="submit" class="button-red">
                                            Lọc sản phẩm
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="table-checkbox-all" type="checkbox"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3">Tiêu đề</th>
                        <th scope="col" class="px-4 py-3">Đường dẫn </th>
                        <th scope="col" class="px-4 py-3">Trạng thái</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $page)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="w-4 px-4 py-3">
                                <div class="flex items-center">
                                    <input id="table-item-checkbox-{{ $page->id }}" type="checkbox"
                                        onclick="event.stopPropagation()" value="{{ $page->id }}"
                                        class="table-item-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                </div>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">{{ $page->title }}</td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">{{ $page->slug }}</td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="inline-block indicator {{ $page->status == 1 ? 'bg-green-700' : 'bg-red-700' }}">
                                    </div>
                                    {{ $page->status == 1 ? 'Hoạt động' : 'Khóa' }}
                                </div>
                            </td>                            
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="{{ $page->name }}" data-dropdown-toggle="{{ $page->name }}-dropdown"
                                    class="inline-flex items-center p-0.5 text-sm text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                    type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div id="{{ $page->name }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="{{ $page->name }}">
                                        <li>
                                            <a href="{{route('admin.resPage',$page->id)}}"
                                                class="block py-2 px-4 hover:bg-gray-100">Khôi Phục</a>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <a href="#" data-modal-target="delete-modal-{{ $page->id }}"
                                            data-modal-toggle="delete-modal-{{ $page->id }}"
                                            class="cursor-pointer block py-2 px-4 text-sm text-red-500 hover:bg-gray-100">Xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{-- start modal --}}
                        <div id="delete-modal-{{ $page->id }}" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="delete-modal-{{ $page->id }}">
                                        @svg('tabler-x', 'w-4 h-4')
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <div class="flex justify-center">
                                            @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                        </div>
                                        <h3 class="mb-5 font-normal">Bạn chắc chắn xóa vĩnh viễn trang này?</h3>

                                        <form action="{{ route('admin.forceDestroy.pages', $page->id) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Xóa
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal --}}
                    @empty
                        <td colspan="6" class="text-center py-4 text-base">
                            <div class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
                                @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                            </div>
                        </td>
                        <!-- Hiển thị "Trống" nếu không có dữ liệu -->
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
    </script>
@endsection