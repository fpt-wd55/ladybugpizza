@extends('layouts.admin')
@section('title', 'Combo')
@section('content')
    {{ Breadcrumbs::render('admin.combos.index') }}
    <div class="relative mt-5 overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="flex flex-col space-y-3 px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
            <div class="flex flex-1 items-center space-x-4">
                <h2 class="text-base font-medium text-gray-700">
                    Combo
                </h2>
            </div>
            <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                <a class="button-blue" href="{{ route('admin.combos.create') }}">
                    @svg('tabler-plus', 'w-5 h-5 mr-2')
                    Thêm combo
                </a>
                <a class="button-red" href="{{ route('admin.trash-combos') }}">
                    @svg('tabler-trash', 'w-5 h-5 mr-2')
                    Thùng rác
                </a>
                <button class="button-light" type="button">
                    @svg('tabler-file-export', 'w-4 h-4 mr-2')
                    Xuất dữ liệu
                </button>
            </div>
        </div>
        <div class="flex flex-col space-y-3 border-t px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
            <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                <div class="flex w-full items-center space-x-3 md:w-full">
                    <form action="{{ route('admin.combos.bulkAction') }}" method="POST">
                        @csrf
                        <input id="selectedIds" name="selected_ids" type="hidden" value="">
                        <div class="hidden" id="actionButtons">
                            <button class="button-red me-2" name="action" type="submit" value="delete">Xóa</button>
                            <h2 class="flex items-center text-base font-medium italic text-gray-700" id="selectedItems">
                            </h2>
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                <form action="{{ route('admin.combos.search') }}" class="flex w-full md:w-40 lg:w-64" method="GET">
                    <div class="relative w-full">
                        <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                            @svg('tabler-search', 'w-5 h-5 text-gray-400')
                        </div>
                        <input class="input ps-10" name="search" placeholder="Tìm kiếm..." type="text" />
                        <input name="context" type="hidden" value="index" />
                    </div>
                </form>
                <div class="flex w-full items-center md:w-auto">
                    <button class="flex w-full items-center justify-center button-light" data-modal-target="filterDropdown" data-modal-toggle="filterDropdown" type="button">
                        @svg('tabler-filter-filled', 'w-5 h-5 me-2')
                        Bộ lọc
                    </button>
                    <form action="{{ route('admin.combos.filter') }}" aria-hidden="true" class="fixed inset-0 z-50 hidden h-modal w-full overflow-y-auto overflow-x-hidden p-4 md:h-full" id="filterDropdown" method="get" tabindex="-1">
                        <div class="relative h-full w-full max-w-2xl md:h-auto">
                            <div class="relative rounded-lg bg-white shadow">
                                <div class="flex items-start justify-between rounded-t px-6 py-4">
                                    <h3 class="text-lg font-semibold text-gray-500">
                                        Bộ lọc
                                    </h3>
                                    <button class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-toggle="filterDropdown" type="button">
                                        @svg('tabler-x', 'w-5 h-5')
                                    </button>
                                </div>
                                <div class="px-4 md:px-6">
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
                                    <h6 class="my-3 text-sm font-medium text-gray-900">Sản phẩm</h6>
                                    <ul class="space-y-2 text-sm">
                                        <li class="flex items-center">
                                            <input @if (request()->input('filter_is_featured') == 1) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="is_featured" name="filter_is_featured" type="checkbox" value="1">
                                            <label class="ml-2 text-sm font-medium text-gray-900" for="is_featured">Sản
                                                phẩm
                                                hot</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input @if (request()->input('filter_combo_discount') == 1) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="combo_discount" name="filter_combo_discount" type="checkbox" value="1">
                                            <label class="ml-2 text-sm font-medium text-gray-900" for="combo_discount">Sản
                                                phẩm
                                                khuyến mãi</label>
                                        </li>
                                    </ul>
                                    <h6 class="my-3 text-sm font-medium text-gray-900">Giá</h6>
                                    <div class="flex items-center">
                                        <div>
                                            <input class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-3 text-sm text-gray-900 focus:ring-0" name="filter_price_min" placeholder="1.000 đ" type="number">
                                        </div>
                                        <span class="mx-4 text-gray-500">-</span>
                                        <div>
                                            <input class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-3 text-sm text-gray-900 focus:ring-0" name="filter_price_max" placeholder="100.000.000 đ" type="number">
                                        </div>
                                    </div>
                                    <h6 class="my-3 text-sm font-medium text-gray-900">Đánh giá</h6>
                                    <ul class="space-y-2 text-sm">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <li class="flex items-center">
                                                <input @if (in_array($i, request()->input('filter_rating', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="filter_rating_{{ $i }}" name="filter_rating[]" type="checkbox" value="{{ $i }}" value="{{ $i }}">
                                                <label class="ml-2 flex items-center gap-1 text-sm font-medium text-gray-900" for="filter_rating_{{ $i }}">
                                                    <div class="gap-0.3 flex items-center">
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
                                <div class="flex items-center space-x-4 rounded-b p-6">
                                    <button class="button-red" type="submit">
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
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 uppercase text-gray-700">
                    <tr>
                        <th class="p-4" scope="col">
                            <div class="flex items-center">
                                <input class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="table-checkbox-all" type="checkbox">
                            </div>
                        </th>
                        <th class="px-4 py-3" scope="col">Combo</th>
                        <th class="px-4 py-3" scope="col">Mã combo</th>
                        <th class="px-4 py-3 text-center" scope="col">Giá</th>
                        <th class="px-4 py-3 text-center" scope="col">Số lượng</th>
                        <th class="px-4 py-3" scope="col">Trạng thái</th>
                        <th class="px-4 py-3" scope="col">
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($combos as $combo)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="w-4 px-4 py-3">
                                <div class="flex items-center">
                                    <input class="table-item-checkbox text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="table-item-checkbox-{{ $combo->id }}" onclick="event.stopPropagation()" type="checkbox" value="{{ $combo->id }}">
                                </div>
                            </td>
                            <td class="flex shrink-0 items-center whitespace-nowrap px-4 py-2 text-gray-900">
                                <a class="shrink-0" data-fslightbox="gallery" href="{{ asset('storage/uploads/combos/' . $combo->image) }}">
                                    <img class="mr-3 h-8 w-8 rounded bg-slate-400 object-cover" loading="lazy" onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'" src="{{ asset('storage/uploads/combos/' . $combo->image) }}">
                                </a>
                                <div class="grid grid-flow-row">
                                    <a class="text-sm hover:text-red-600" href="{{ route('admin.combos.edit', $combo) }}">{{ $combo->name }}</a>
                                    <div class="flex items-center gap-1">
                                        <p>{{ round($combo->avg_rating, 1) }}</p>
                                        <div class="gap-0.3 flex items-center">
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
                            <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                <a class="hover:text-red-600" href="{{ route('admin.combos.edit', $combo) }}">
                                    {{ $combo->sku }}
                                </a>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-center text-gray-900">
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
                            <td class="whitespace-nowrap px-4 py-2 text-center text-gray-900">
                                <span class="text-xs font-medium">
                                    {{ $combo->quantity }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-center text-gray-900">
                                <div class="flex items-center">
                                    <div class="indicator {{ $combo->status == 1 ? 'bg-green-700' : 'bg-red-700' }} inline-block">
                                    </div>
                                    {{ $combo->status == 1 ? 'Hoạt động' : 'Khóa' }}
                                </div>
                            </td>
                            <td class="flex items-center justify-end px-4 py-3">
                                <button class="inline-flex items-center rounded-lg p-0.5 text-center text-sm text-gray-500 hover:text-gray-800 focus:outline-none" data-dropdown-toggle="{{ $combo->sku }}-dropdown" id="{{ $combo->sku }}" type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow" id="{{ $combo->sku }}-dropdown">
                                    <ul aria-labelledby="{{ $combo->sku }}" class="py-1 text-sm text-gray-700">
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('client.product.show', $combo->slug) }}" target="_blank">Xem</a>
                                        </li>
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('admin.combos.evaluation', $combo) }}">Đánh giá</a>
                                        </li>
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('admin.combos.edit', $combo) }}">Cập nhật</a>
                                        </li>
                                        <li>
                                            <span class="block cursor-pointer px-4 py-2 text-sm text-red-500 hover:bg-gray-100" data-modal-target="delete-modal-{{ $combo->sku }}" data-modal-toggle="delete-modal-{{ $combo->sku }}">Xóa</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0" id="delete-modal-{{ $combo->sku }}" tabindex="-1">
                                    <div class="relative max-h-full w-full max-w-md p-4">
                                        <div class="relative rounded-lg bg-white shadow">
                                            <button class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-hide="delete-modal-{{ $combo->sku }}" type="button">
                                                @svg('tabler-x', 'w-4 h-4')
                                            </button>
                                            <div class="p-4 text-center md:p-5">
                                                <div class="flex justify-center">
                                                    @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                                </div>
                                                <h3 class="mb-5 font-normal">Bạn có muốn xóa sản phẩm này không?</h3>

                                                <div class="flex items-center justify-center">
                                                    <form action="{{ route('admin.combos.destroy', $combo) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-0" type="submit">
                                                            Xóa
                                                        </button>
                                                    </form>

                                                    <button class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:z-10 focus:outline-none focus:ring-0" data-modal-hide="delete-modal-{{ $combo->sku }}" type="button">
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
                        <td class="py-4 text-center text-base" colspan="6">
                            <div class="flex h-80 w-full flex-col items-center justify-center rounded-lg bg-white p-6">
                                @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                <p class="mt-4 text-sm text-gray-500">Dữ liệu trống.</p>
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
        document.querySelectorAll('.star-icon').forEach((star, index) => {
            star.addEventListener('click', () => {
                const rating = index + 1;
                const checkbox = document.getElementById('filter_rating_' + rating);
                checkbox.checked = !checkbox.checked;
            });
        });
    </script>
@endsection
