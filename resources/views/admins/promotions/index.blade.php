@extends('layouts.admin')
@section('title', 'Mã giảm giá')

@section('content')
    {{ Breadcrumbs::render('admin.promotions.index') }}
    <div class="relative mt-5 overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="overflow-x-auto">
            <div class="flex flex-col space-y-3 px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
                <div class="flex flex-1 items-center space-x-4">
                    <h2 class="text-base font-medium text-gray-700">
                        Mã giảm giá
                    </h2>
                </div>
                <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                    <a class="button-blue" href="{{ route('admin.promotions.create') }}">
                        @svg('tabler-plus', 'w-5 h-5 mr-2')
                        Thêm mã giảm giá
                    </a>
                    <a class="button-red" href="{{ route('admin.promotions.trash') }}">
                        @svg('tabler-trash', 'w-5 h-5 mr-2')
                        Thùng rác
                    </a>
                    <a class="hover:text-primary-700 flex flex-shrink-0 items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 hover:bg-gray-100 focus:z-10 focus:outline-none focus:ring-0" href="{{ route('admin.promotions.export') }}">
                        @svg('tabler-file-export', 'w-4 h-4 mr-2')
                        Xuất dữ liệu
                    </a>
                </div>
            </div>
            <div class="flex flex-col space-y-3 border-t px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
                <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                    <div class="flex w-full items-center space-x-3 md:w-full">
                        <form action="{{ route('admin.promotions.bulkAction') }}" method="POST">
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
                    <form action="{{ route('admin.promotions.search') }}" class="flex w-full md:w-40 lg:w-64">
                        <div class="relative w-full">
                            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                                @svg('tabler-search', 'w-5 h-5 text-gray-400')
                            </div>
                            <input class="input ps-10" name="search" placeholder="Tìm kiếm..." type="text" />
                        </div>
                    </form>
                    <div class="flex w-full items-center space-x-3 md:w-auto">
                        <button class="hover:text-primary-700 flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:z-10 focus:outline-none focus:ring-0 md:w-auto" data-modal-target="filterDropdown" data-modal-toggle="filterDropdown" type="button">
                            @svg('tabler-filter-filled', 'w-5 h-5 me-2')
                            Bộ lọc
                        </button>
                        <form action="{{ route('admin.promotions.filter') }}" aria-hidden="true" class="fixed inset-0 z-50 hidden h-modal w-full overflow-y-auto overflow-x-hidden p-4 md:h-full" id="filterDropdown" method="get" tabindex="-1">
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
                                        <h6 class="my-3 text-sm font-medium text-gray-900">Loại mã</h6>
                                        <ul class="space-y-2 text-sm">
                                            <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                                <li class="flex items-center">
                                                    <input @if (in_array(1, request()->input('filter_discount_type', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="discount-type-1" name="filter_discount_type[]" type="checkbox" value="1">
                                                    <label class="ml-2 text-sm font-medium text-gray-900" for="discount-type-1">Giảm theo %</label>
                                                </li>
                                                <li class="flex items-center">
                                                    <input @if (in_array(2, request()->input('filter_discount_type', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="discount-type-2" name="filter_discount_type[]" type="checkbox" value="2">
                                                    <label class="ml-2 text-sm font-medium text-gray-900" for="discount-type-2">Giảm theo giá
                                                        tiền</label>
                                                </li>
                                            </div>
                                        </ul>
                                        <h6 class="my-3 text-sm font-medium text-gray-900">Phạm vi</h6>
                                        <ul class="space-y-2 text-sm">
                                            <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                                <li class="flex items-center">
                                                    <input @if (in_array(0, request()->input('filter_range', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="range-0" name="filter_range[]" type="checkbox" value="0">
                                                    <label class="ml-2 text-sm font-medium text-gray-900" for="range-0">Tất cả</label>
                                                </li>
                                                @foreach ($ranks as $rank)
                                                    <li class="flex items-center">
                                                        <input @if (in_array($rank->id, request()->input('filter_range', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="range-{{ $rank->id }}" name="filter_range[]" type="checkbox" value="{{ $rank->id }}">
                                                        <label class="ml-2 text-sm font-medium text-gray-900" for="range-{{ $rank->id }}">Thành viên
                                                            {{ $rank->name }}</label>
                                                    </li>
                                                @endforeach
                                            </div>
                                        </ul>
                                        <h6 class="my-3 text-sm font-medium text-gray-900">Thời gian</h6>
                                        <div class="flex items-center">
                                            <div>
                                                <input class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-3 text-sm text-gray-900 focus:ring-0" name="filter_date_min" placeholder="1.000 đ" type="date" value="{{ request()->input('filter_date_min') }}">
                                            </div>
                                            <span class="mx-4 text-gray-500">-</span>
                                            <div>
                                                <input class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-3 text-sm text-gray-900 focus:ring-0" name="filter_date_max" placeholder="100.000.000 đ" type="date" value="{{ request()->input('filter_date_max') }}">
                                            </div>
                                        </div>
                                    </div>
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
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 uppercase text-gray-700">
                    <tr>
                        <th class="p-4" scope="col">
                            <div class="flex items-center">
                                <input class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="table-checkbox-all" type="checkbox">
                            </div>
                        </th>
                        <th class="px-4 py-3" scope="col">Mã giảm giá</th>
                        <th class="px-4 py-3" scope="col">Loại giảm giá</th>
                        <th class="px-4 py-3 text-center" scope="col">Giá trị giảm giá</th>
                        <th class="px-4 py-3 text-center" scope="col">Số lượng</th>
                        <th class="px-4 py-3 text-center" scope="col">Lượt sử dụng</th>
                        <th class="px-4 py-3" scope="col">
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($promotions as $promotion)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="w-4 px-4 py-3">
                                <div class="flex items-center">
                                    <input class="table-item-checkbox text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="table-item-checkbox-{{ $promotion->id }}" onclick="event.stopPropagation()" type="checkbox" value="{{ $promotion->id }}">
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                <a class="font-medium hover:text-red-600" data-modal-target="detail-modal-{{ $promotion->id }}" data-modal-toggle="detail-modal-{{ $promotion->id }}" href="#">{{ $promotion->code }}</a>
                                <p>{{ $promotion->name }}</p>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                @if ($promotion->discount_type == '1')
                                    Giảm theo %
                                @elseif ($promotion->discount_type == '2')
                                    Giảm theo số tiền
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-center text-gray-900">
                                @if ($promotion->discount_type == '1')
                                    <div class="space-y-2">
                                        <span class="badge-red">{{ number_format($promotion->discount_value) }}%</span>
                                        <p class="badge-light">Giảm tối đa {{ number_format($promotion->max_discount) }}₫</p>
                                    </div>
                                @elseif ($promotion->discount_type == '2')
                                    <span class="badge-red">{{ number_format($promotion->discount_value) }}₫</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-center text-gray-900">
                                {{ number_format($promotion->quantity) }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-center text-gray-900">
                                {{ number_format($promotion->usageCount()) }}
                            </td>
                            <td class="flex items-center justify-end px-4 py-3">
                                <button class="inline-flex items-center rounded-lg p-0.5 text-center text-sm text-gray-500 hover:text-gray-800 focus:outline-none" data-dropdown-toggle="{{ $promotion->id }}-dropdown" id="{{ $promotion->id }}" type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow" id="{{ $promotion->id }}-dropdown">
                                    <ul aria-labelledby="{{ $promotion->id }}" class="py-1 text-sm text-gray-700">
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100" data-modal-target="detail-modal-{{ $promotion->id }}" data-modal-toggle="detail-modal-{{ $promotion->id }}" href="#">Chi tiết </a>
                                        </li>
                                        @if (!$promotion->orders()->exists())
                                            <li>
                                                <a class="block cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('admin.promotions.edit', $promotion->id) }}">
                                                    Cập nhật
                                                </a>
                                            </li>
                                            <li>
                                                <a class="block cursor-pointer px-4 py-2 text-sm text-red-500 hover:bg-gray-100" data-modal-target="delete-modal-{{ $promotion->id }}" data-modal-toggle="delete-modal-{{ $promotion->id }}" href="#">Xóa</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <div class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0" id="delete-modal-{{ $promotion->id }}" tabindex="-1">
                            <div class="relative max-h-full w-full max-w-md p-4">
                                <div class="relative rounded-lg bg-white shadow">
                                    <button class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-hide="delete-modal-{{ $promotion->id }}" type="button">
                                        @svg('tabler-x', 'w-4 h-4')
                                    </button>
                                    <div class="p-4 text-center md:p-5">
                                        <div class="flex justify-center">
                                            @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                        </div>
                                        <h3 class="mb-5 font-normal">Bạn có muốn xóa mã giảm giá này không?</h3>
                                        <form action="{{ route('admin.promotions.destroy', $promotion->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300" type="submit">
                                                Xóa
                                            </button>
                                        </form>

                                        <button class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100" data-modal-hide="delete-modal-{{ $promotion->id }}" type="button">Không</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div aria-hidden="true" class="fixed left-0 right-0 top-10 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 md:h-full" id="detail-modal-{{ $promotion->id }}" tabindex="-1">
                            <div class="relative max-h-full w-full max-w-md p-4">
                                <div class="no-scrollbar relative h-full overflow-y-auto rounded-lg bg-white p-4 shadow sm:p-5">
                                    <div>
                                        <div class="container mx-auto mb-10">
                                            <div class="px-15 relative rounded-lg bg-gradient-to-br from-[#bf0808] to-[#f52929] py-8 text-center text-white shadow-md">
                                                <h3 class="mb-4 text-lg font-semibold">
                                                    <p>
                                                        Giảm
                                                        {{ $promotion->discount_type == '1' ? $promotion->discount_value . '%' : number_format($promotion->discount_value) . 'đ' }}
                                                        @if ($promotion->max_discount)
                                                            Giảm tối đa {{ number_format($promotion->max_discount) }}₫
                                                        @endif
                                                    </p>
                                                    <p class="mt-1">
                                                        @if ($promotion->min_order_total)
                                                            Đơn Tối Thiểu {{ number_format($promotion->min_order_total) }}₫
                                                        @endif
                                                    </p>
                                                </h3>
                                                <div class="flex items-center justify-center space-x-2">
                                                    <span class="rounded-l border border-dashed px-4 py-2" id="promotion-{{ $promotion->code }}">{{ $promotion->code }}</span>
                                                    <button class="cursor-pointer rounded-r border border-white bg-white px-2 py-2 text-red-600 transition hover:bg-slate-200" data-copy-to-clipboard-content-type="textContent" data-copy-to-clipboard-target="promotion-{{ $promotion->code }}" data-tooltip-target="tooltip-promotion-details" onclick="notiCopied()">Sao chép</button>
                                                </div>
                                                <div class="absolute left-0 top-1/2 -ml-6 h-12 w-12 -translate-y-1/2 transform rounded-full bg-white">
                                                </div>
                                                <div class="absolute right-0 top-1/2 -mr-6 h-12 w-12 -translate-y-1/2 transform rounded-full bg-white">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 content-between gap-4">
                                            <div class="space-y-4">
                                                <div class="rounded-lg">
                                                    <label class="font-semibold">Tên mã giảm giá</label>
                                                    <p class="mt-3 text-gray-800">
                                                        {{ $promotion->name }}
                                                    </p>
                                                </div>
                                                <div class="rounded-lg">
                                                    <label class="font-semibold">Hạn sử dụng mã</label>
                                                    <p class="mt-3 text-gray-800">
                                                        {{ \Carbon\Carbon::parse($promotion->start_date)->format('d/m/Y H:i') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($promotion->end_date)->format('d/m/Y H:i') }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center gap-16">
                                                    <div class="rounded-lg">
                                                        <label class="font-semibold">Số lượng</label>
                                                        <p class="mt-3 text-gray-800">
                                                            {{ $promotion->quantity }}
                                                        </p>
                                                    </div>
                                                    <div class="rounded-lg">
                                                        <label class="font-semibold">Đối tượng sử dụng</label>
                                                        <p class="mt-3 text-gray-800">
                                                            @if ($promotion->is_global == '1')
                                                                Tất cả
                                                            @else
                                                                Thành viên
                                                                {{ $promotion->rank?->name ?? 'Không xác định' }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="rounded-lg">
                                                    <label class="font-semibold">Trạng thái</label>
                                                    <p class="mb-6 mt-3 text-gray-800">
                                                        <span class="{{ $promotion->status == 1 ? 'bg-green-500' : 'bg-red-500' }} inline-flex shrink-0 items-center rounded px-2.5 py-0.5 text-xs font-medium text-white">
                                                            {{ $promotion->status == 1 ? 'Hoạt động' : 'Khóa' }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="space-y-4">
                                                <div class="rounded-lg">
                                                    <button class="button-red w-full" data-modal-hide="detail-modal-{{ $promotion->id }}" type="button">Đồng
                                                        ý</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                {{ $promotions->onEachSide(1)->links() }}
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

    <script>
        const notiCopied = () => {
            setTimeout(() => {
                this.innerText = 'Đã sao chép';
            }, 1000);
        }
    </script>
@endsection
