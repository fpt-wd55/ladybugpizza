@extends('layouts.admin')
@section('title', 'Mã giảm giá | Thùng rác')

@section('content')
    {{ Breadcrumbs::render('admin.promotions.trash') }}
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
                    <a href="{{ route('admin.promotions.index') }}" class="button-gray">Quay
                        lại</a>
                </div>
            </div>
            <div
                class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4 border-t">
                <div
                    class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                    <div class="flex items-center space-x-3 w-full md:w-full">
                        <form method="POST" action="{{ route('admin.promotions.bulkAction') }}">
                            @csrf
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
                        <th scope="col" class="px-4 py-3">Tên mã giảm giá</th>
                        <th scope="col" class="px-4 py-3">Mã giảm giá</th>
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
                            <td class="w-4 px-4 py-3">
                                <div class="flex items-center">
                                    <input id="table-item-checkbox-{{ $promotion->id }}" type="checkbox"
                                        onclick="event.stopPropagation()" value="{{ $promotion->id }}"
                                        class="table-item-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                </div>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">{{ $promotion->name }}</td>
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
                                    {{ number_format($promotion->discount_value) }}₫
                                @endif
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                {{ number_format($promotion->quantity) }}
                            </td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="{{ $promotion->name }}" data-dropdown-toggle="{{ $promotion->name }}-dropdown"
                                    class="inline-flex items-center p-0.5 text-sm text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                    type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div id="{{ $promotion->name }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="{{ $promotion->name }}">
                                        <li>
                                            <a href="{{ route('admin.resPromotion', $promotion->id) }}"
                                                class="block py-2 px-4 hover:bg-gray-100">Khôi Phục</a>
                                        </li>
                                    </ul>
                                    {{-- <div class="py-1">
                                        <a href="#" data-modal-target="delete-modal-{{ $promotion->id }}"
                                            data-modal-toggle="delete-modal-{{ $promotion->id }}"
                                            class="cursor-pointer block py-2 px-4 text-sm text-red-500 hover:bg-gray-100">Xóa</a>
                                    </div> --}}
                                </div>
                            </td>
                        </tr>
                        {{-- start modal --}}
                        {{-- <div id="delete-modal-{{ $promotion->id }}" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="delete-modal-{{ $promotion->id }}">
                                        @svg('tabler-x', 'w-4 h-4')
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <div class="flex justify-center">
                                            @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                        </div>
                                        <h3 class="mb-5 font-normal">Bạn chắc chắn xóa vĩnh viễn Topping này?</h3>

                                        <form action="{{ route('admin.forceDelete-Toppings', $promotion->id) }}"
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
                        </div> --}}
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
                {{ $promotions->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        tableCheckboxItem('table-checkbox-all', 'table-item-checkbox');
    </script>
@endsection
