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
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">Mã</th>
                        <th scope="col" class="px-4 py-3">Sản phẩm</th>
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
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                {{ $combo->sku }}</td>
                            <td class="flex items-center px-4 py-2 text-gray-900 whitespace-nowrap shrink-0">
                                <a class="shrink-0" data-fslightbox="gallery"
                                    href="{{ asset('storage/uploads/products/' . $combo->image) }}">
                                    <img loading="lazy" src="{{ asset('storage/uploads/products/' . $combo->image) }}"
                                        onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'"
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
                                            <a href="#" target="_blank"
                                                class="block py-2 px-4 hover:bg-gray-100">Xem</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block py-2 px-4 hover:bg-gray-100">Đánh giá</a>
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
                                {{-- Modal xác nhận xóa --}}
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
                                <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
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
