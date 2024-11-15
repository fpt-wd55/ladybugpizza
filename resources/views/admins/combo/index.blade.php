@extends('layouts.admin')
@section('title', 'Combo')
@section('content')
    {{ Breadcrumbs::render('admin.combos.index') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h2 class="font-medium text-gray-700 text-base">
                    Combo
                </h2>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <a href="{{ route('admin.combos.create') }}" class="button-blue">
                    @svg('tabler-plus', 'w-5 h-5 mr-2')
                    Thêm combo
                </a>
                <a href="{{ route('admin.trash-combos') }}" class="button-red">
                    @svg('tabler-trash', 'w-5 h-5 mr-2')
                    Thùng rác
                </a>
                <button type="button"
                    class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0">
                    @svg('tabler-file-export', 'w-4 h-4 mr-2')
                    Xuất dữ liệu
                </button>
            </div>
        </div>
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4 border-t">
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <div class="flex items-center space-x-3 w-full md:w-full">
                    <form method="POST" action="{{ route('admin.combos.bulkAction') }}">
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
                <form class="flex w-full md:w-40 lg:w-64" action="{{ route('admin.combos.search') }}" method="GET">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            @svg('tabler-search', 'w-5 h-5 text-gray-400')
                        </div>
                        <input type="text" name="search" class="input ps-10" placeholder="Tìm kiếm..." />
                        <input type="hidden" name="context" value="index" />
                    </div>
                </form>
                <div class="flex items-center w-full md:w-auto">
                    <button data-modal-target="filterDropdown" data-modal-toggle="filterDropdown"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                        type="button">
                        @svg('tabler-filter-filled', 'w-5 h-5 me-2')
                        Bộ lọc
                    </button>
                    <form action="{{ route('admin.combos.filter') }}" method="get" id="filterDropdown" tabindex="-1"
                        aria-hidden="true"
                        class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full">
                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
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
                                    <h6 class="my-3 text-sm font-medium text-gray-900">Sản phẩm</h6>
                                    <ul class="space-y-2 text-sm">
                                        <li class="flex items-center">
                                            <input id="is_featured" type="checkbox" name="filter_is_featured" value="1"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                                @if (request()->input('filter_is_featured') == 1) checked @endif>
                                            <label for="is_featured" class="ml-2 text-sm font-medium text-gray-900">Sản
                                                phẩm
                                                hot</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="combo_discount" type="checkbox" name="filter_combo_discount"
                                                value="1"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                                @if (request()->input('filter_combo_discount') == 1) checked @endif>
                                            <label for="combo_discount" class="ml-2 text-sm font-medium text-gray-900">Sản
                                                phẩm
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
                                                    @if (in_array($i, request()->input('filter_rating', []))) checked @endif>
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
                                <div class="flex items-center p-6 space-x-4 rounded-b dark:border-gray-600">
                                    <button type="submit" class="button-red">
                                        Lọc combo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                        <th scope="col" class="px-4 py-3">Mã combo</th>
                        <th scope="col" class="px-4 py-3">Combo</th>
                        <th scope="col" class="px-4 py-3 text-center">Giá</th>
                        <th scope="col" class="px-4 py-3 text-center">Số lượng</th>
                        <th scope="col" class="px-4 py-3 text-center">Trạng thái</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($combos as $combo)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="w-4 px-4 py-3">
                                <div class="flex items-center">
                                    <input id="table-item-checkbox-{{ $combo->id }}" type="checkbox"
                                        onclick="event.stopPropagation()" value="{{ $combo->id }}"
                                        class="table-item-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                </div>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                {{ $combo->sku }}</td>
                            <td class="flex items-center px-4 py-2 text-gray-900 whitespace-nowrap shrink-0">
                                <a class="shrink-0" data-fslightbox="gallery"
                                    href="{{ asset('storage/uploads/combos/' . $combo->image) }}">
                                    <img loading="lazy" src="{{ asset('storage/uploads/combos/' . $combo->image) }}"
                                        onerror="this.src='{{ asset('storage/uploads/combos/product-placehoder.jpg') }}'"
                                        class="w-8 h-8 mr-3 rounded bg-slate-400 object-cover">
                                </a>
                                <div class="grid grid-flow-row">
                                    <span class="text-sm">{{ $combo->name }}</span>
                                    <div class="flex items-center gap-1">
                                        <p>{{ round($combo->avg_rating, 1) }}</p>
                                        <div class="flex items-center gap-0.3">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $combo->avg_rating)
                                                    @svg('tabler-star-filled', 'icon-sm text-red-500')
                                                @else
                                                    @svg('tabler-star', 'icon-sm text-red-500')
                                                @endif
                                            @endfor
                                        </div>
                                        <p>({{ $combo->total_rating }})</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap text-center">
                                <div class="grid grid-flow-row">
                                    @if ($combo->discount_price == 0)
                                        <span class="text-sm">
                                            {{ number_format($combo->price) }}₫
                                        </span>
                                    @else
                                        <span class="text-sm line-through">{{ number_format($combo->price) }}₫</span>
                                        <span class="text-sm">
                                            {{ number_format($combo->discount_price) }}₫
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap text-center">
                                <span class=" text-xs font-medium">
                                    @if (count($combo->category->attributes) > 0)
                                        <span
                                            class="text-white bg-green-400 inline-flex shrink-0 items-center rounded px-2.5 py-0.5">Thuộc
                                            tính</span>
                                    @else
                                        @if ($combo->quantity == 0)
                                            <span
                                                class="text-red-500 bg-yellow-100 inline-flex shrink-0 items-center rounded px-2.5 py-0.5">Hết
                                                hàng</span>
                                        @else
                                            {{ $combo->quantity }}
                                        @endif
                                    @endif
                                </span>
                            </td>
                            <td
                                class="px-4 py-2 text-gray-900 whitespace-nowrap text-center font-medium {{ $combo->status == 1 ? 'text-green-700' : 'text-red-700' }}">
                                {{ $combo->status == 1 ? 'Hoạt động' : 'Khóa' }}
                            </td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="{{ $combo->sku }}" data-dropdown-toggle="{{ $combo->sku }}-dropdown"
                                    class="inline-flex items-center p-0.5 text-sm text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                    type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div id="{{ $combo->sku }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="{{ $combo->sku }}">
                                        <li>
                                            <a href="{{ route('client.product.showCombo', $combo->slug) }}" target="_blank"
                                                class="block py-2 px-4 hover:bg-gray-100">Xem</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.combos.evaluation', $combo) }}"
                                                class="block py-2 px-4 hover:bg-gray-100">Đánh giá</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.combos.edit', $combo) }}"
                                                class="block py-2 px-4 hover:bg-gray-100">Cập nhật</a>
                                        </li>
                                        <li>
                                            <span data-modal-target="delete-modal-{{ $combo->sku }}"
                                                data-modal-toggle="delete-modal-{{ $combo->sku }}"
                                                class="cursor-pointer block py-2 px-4 text-sm text-red-500 hover:bg-gray-100">Xóa</span>
                                        </li>
                                    </ul>
                                </div>
                                <div id="delete-modal-{{ $combo->sku }}" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                data-modal-hide="delete-modal-{{ $combo->sku }}">
                                                @svg('tabler-x', 'w-4 h-4')
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <div class="flex justify-center">
                                                    @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                                </div>
                                                <h3 class="mb-5 font-normal">Bạn có muốn xóa sản phẩm này không?</h3>

                                                <div class="flex justify-center items-center">
                                                    <form action="{{ route('admin.combos.destroy', $combo) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-0 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Xóa
                                                        </button>
                                                    </form>

                                                    <button data-modal-hide="delete-modal-{{ $combo->sku }}"
                                                        type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-0">
                                                        Không
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td colspan="6" class="text-center py-4 text-base">
                            <div class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
                                @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống.</p>
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4">
                {{ $combos->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        tableCheckboxItem('table-checkbox-all', 'table-item-checkbox');
    </script>
@endsection
