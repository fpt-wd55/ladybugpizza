@extends('layouts.admin')
@section('title', 'Mã giảm giá')

@section('content')
    {{ Breadcrumbs::render('admin.promotions.index') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <div
                class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                <div class="flex items-center flex-1 space-x-4">
                    <h2 class="font-medium text-gray-700 text-base">
                        Mã giảm giá
                    </h2>
                </div>
                <div
                    class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                    <a href="{{ route('admin.promotions.create') }}" class="button-blue">
                        @svg('tabler-plus', 'w-5 h-5 mr-2')
                        Thêm mới mã giảm giá
                    </a>
                    <a href="{{ route('admin.promotions.export') }}"
                        class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0">
                        @svg('tabler-file-export', 'w-4 h-4 mr-2')
                        Xuất dữ liệu
                    </a>
                </div>
            </div>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">STT</th>
                        <th scope="col" class="px-4 py-3">Tên mã giảm giá</th>
                        <th scope="col" class="px-4 py-3">Loại giảm giá</th>
                        <th scope="col" class="px-4 py-3">Giá trị giảm giá</th>
                        <th scope="col" class="px-4 py-3">Số lượng</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($promotions as $promotion)
                        <tr class="border-b hover:bg-gray-100">
                            <!-- Tính toán STT dựa trên trang hiện tại -->
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                {{ ($promotions->currentPage() - 1) * $promotions->perPage() + $loop->iteration }}</td>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">{{ $promotion->code }}</td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                @if ($promotion->discount_type == '1')
                                    Giảm theo %
                                @elseif ($promotion->discount_type == '2')
                                    Giảm theo số tiền
                                @endif
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                @if ($promotion->discount_type == '1')
                                    {{ number_format($promotion->discount_value) }}%
                                @elseif ($promotion->discount_type == '2')
                                    {{ number_format($promotion->discount_value) }}đ
                                @endif
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">{{ number_format($promotion->quantity) }}
                            </td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="{{ $promotion->id }}" data-dropdown-toggle="{{ $promotion->id }}-dropdown"
                                    class="inline-flex items-center p-0.5 text-sm text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                    type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div id="{{ $promotion->id }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="{{ $promotion->id }}">
                                        <li>
                                            <a href="#" class="block py-2 px-4 hover:bg-gray-100"
                                                data-modal-target="detail-modal-{{ $promotion->id }}"
                                                data-modal-toggle="detail-modal-{{ $promotion->id }}">Chi tiết </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.promotions.edit', $promotion->id) }}"
                                                class="cursor-pointer block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Cập
                                                nhật</a>
                                        </li>
                                        <li>
                                            <a href="#" data-modal-target="delete-modal-{{ $promotion->id }}"
                                                data-modal-toggle="delete-modal-{{ $promotion->id }}"
                                                class="cursor-pointer block py-2 px-4 text-sm text-red-500 hover:bg-gray-100">Xóa</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        {{-- delete modal --}}
                        <div id="delete-modal-{{ $promotion->id }}" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="delete-modal-{{ $promotion->id }}">
                                        @svg('tabler-x', 'w-4 h-4')
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <div class="flex justify-center">
                                            @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                        </div>
                                        <h3 class="mb-5 font-normal">Bạn có muốn xóa mã giảm giá này không?</h3>
                                        <form action="{{ route('admin.promotions.destroy', $promotion->id) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Xóa
                                            </button>
                                        </form>

                                        <button data-modal-hide="delete-modal-{{ $promotion->id }}" type="button"
                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Không</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end delete modal --}}

                        {{-- detail modal --}}
                        <div id="detail-modal-{{ $promotion->id }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div
                                    class="relative p-4 bg-white rounded-lg shadow sm:p-5 h-full overflow-y-auto no-scrollbar">
                                    <div>
                                        <div class="container mx-auto mb-10">
                                            <div
                                                class="bg-gradient-to-br from-[#bf0808] to-[#f52929] text-white text-center py-8 px-15 rounded-lg shadow-md relative">
                                                <h3 class="text-lg font-semibold mb-4">
                                                    <p class="">
                                                        Giảm @if ($promotion->discount_type == '1')
                                                            {{ number_format($promotion->discount_value) }}%
                                                        @elseif ($promotion->discount_type == '2')
                                                            {{ number_format($promotion->discount_value) }}₫
                                                        @endif Giảm tối đa
                                                        {{ number_format($promotion->max_discount) }}₫
                                                    </p>
                                                    <p class="mt-1">
                                                        Đơn Tối Thiểu {{ number_format($promotion->min_order_total) }}₫
                                                    </p>
                                                </h3>
                                                <div class="flex items-center space-x-2 justify-center">
                                                    <span id="promotion-{{ $promotion->code }}"
                                                        class="border-dashed border px-4 py-2 rounded-l">{{ $promotion->code }}</span>
                                                    <button
                                                        data-copy-to-clipboard-target="promotion-{{ $promotion->code }}"
                                                        data-copy-to-clipboard-content-type="textContent"
                                                        data-tooltip-target="tooltip-promotion-details"
                                                        class="border border-white bg-white hover:bg-slate-200 transition text-red-600 px-2 py-2 rounded-r cursor-pointer">Sao
                                                        chép</button>
                                                </div>
                                                <div
                                                    class="w-12 h-12 bg-white rounded-full absolute top-1/2 transform -translate-y-1/2 left-0 -ml-6">
                                                </div>
                                                <div
                                                    class="w-12 h-12 bg-white rounded-full absolute top-1/2 transform -translate-y-1/2 right-0 -mr-6">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 gap-4 content-between">
                                            <div class="space-y-4">
                                                <div class="rounded-lg">
                                                    <label class="font-semibold">Hạn sử dụng mã</label>
                                                    <p class="text-gray-800 mt-3">
                                                        {{ \Carbon\Carbon::parse($promotion->start_date)->format('d/m/Y H:i') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($promotion->end_date)->format('d/m/Y H:i') }}
                                                    </p>
                                                </div>
                                                <div class="rounded-lg">
                                                    <label class="font-semibold">Số lượng</label>
                                                    <p class="text-gray-800 mt-3">
                                                        {{ $promotion->quantity }}
                                                    </p>
                                                </div>
                                                <div class="rounded-lg">
                                                    <label class="font-semibold">Đối tượng sử dụng</label>
                                                    <p class="text-gray-800 mt-3">
                                                        @if ($promotion->is_global == '1')
                                                            Tất cả
                                                        @else
                                                            Thành viên {{ $promotion->rank->name }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="rounded-lg">
                                                    <label class="font-semibold">Trạng thái</label>
                                                    <p class="text-gray-800 mt-3 mb-6">
                                                        <span
                                                            class="text-white {{ $promotion->status == 1 ? 'bg-green-500' : 'bg-red-500' }} inline-flex shrink-0 items-center rounded px-2.5 py-0.5 text-xs font-medium">
                                                            {{ $promotion->status == 1 ? 'Hoạt động' : 'Khóa' }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="space-y-4">
                                                <div class="rounded-lg">
                                                    <button data-modal-hide="detail-modal-{{ $promotion->id }}"
                                                        type="button" class="button-red w-full">Đồng
                                                        ý</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end detail modal --}}
                        @empty
                            <td colspan="6" class="text-center py-4 text-base">
                                <div class="flex flex-col items-center justify-center p-6 rounded-lg bg-white w-full h-80">
                                    @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                    <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
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
        const clipboard = FlowbiteInstances.getInstance('CopyClipboard', 'contact-details');
        const tooltip = FlowbiteInstances.getInstance('Tooltip', 'tooltip-contact-details');
    </script>
@endsection
