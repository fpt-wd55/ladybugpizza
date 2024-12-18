@extends('layouts.admin')
@section('title', 'Topping')

@section('content')
    {{ Breadcrumbs::render('admin.toppings.index') }}
    <div class="relative mt-5 overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="overflow-x-auto">
            <div class="flex flex-col space-y-3 px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
                <div class="flex flex-1 items-center space-x-4">
                    <h2 class="text-base font-medium text-gray-700">
                        Topping
                    </h2>
                </div>
                <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                    <a class="button-blue" href="{{ route('admin.toppings.create') }}">
                        @svg('tabler-plus', 'w-5 h-5 mr-2')
                        Thêm topping
                    </a>
                    <a class="button-red" href="{{ route('admin.trash-topping') }}">
                        @svg('tabler-trash', 'w-5 h-5 mr-2')
                        Thùng rác
                    </a>
                    <a class="button-light" href="{{ route('admin.toppings.export') }}">
                        @svg('tabler-file-export', 'w-4 h-4 mr-2')
                        Xuất dữ liệu
                    </a>
                </div>
            </div>
            <div class="flex flex-col space-y-3 border-t px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
                <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                    <div class="flex w-full items-center space-x-3 md:w-full">
                        <form action="{{ route('admin.toppings.bulkAction') }}" method="POST">
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
                    <form action="{{ route('admin.toppings.search') }}" class="flex w-full md:w-40 lg:w-64">
                        <div class="relative w-full">
                            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                                @svg('tabler-search', 'w-5 h-5 text-gray-400')
                            </div>
                            <input class="input ps-10" name="search" placeholder="Tìm kiếm..." type="text" value="{{ old('search', request('search')) }}"/>
                        </div>
                    </form>
                    <div class="flex w-full items-center md:w-auto">
                        <button class="flex w-full items-center justify-center button-light" data-modal-target="filterDropdown" data-modal-toggle="filterDropdown" type="button">
                            @svg('tabler-filter-filled', 'w-5 h-5 me-2')
                            Bộ lọc
                        </button>
                        <form action="{{ route('admin.toppings.filter') }}" aria-hidden="true" class="fixed inset-0 z-50 hidden h-modal w-full overflow-y-auto overflow-x-hidden p-4 md:h-full" id="filterDropdown" method="get" tabindex="-1">
                            <div class="relative h-full w-full max-w-2xl md:h-auto">
                                <!-- Modal content -->
                                <div class="relative rounded-lg bg-white shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-start justify-between rounded-t px-6 py-4">
                                        <h3 class="text-lg font-semibold text-gray-500">
                                            Bộ lọc
                                        </h3>
                                        <button class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-toggle="filterDropdown" type="button">
                                            @svg('tabler-x', 'w-5 h-5')
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="px-4 md:px-6">
                                        <h6 class="mb-3 text-sm font-medium text-gray-900">Danh mục</h6>
                                        <ul class="space-y-2 text-sm">
                                            <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                                @foreach ($categories as $category)
                                                    <li class="flex items-center">
                                                        <input @if (in_array($category->id, request()->input('filter_category', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="admin" name="filter_category[]" type="checkbox" value="{{ $category->id }}">
                                                        <label class="ml-2 text-sm font-medium text-gray-900" for="admin">{{ $category->name }}</label>
                                                    </li>
                                                @endforeach
                                            </div>
                                        </ul>
                                        <h6 class="my-3 text-sm font-medium text-gray-900">Giá</h6>
                                        <div class="flex items-center">
                                            <div>
                                                <input class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-3 text-sm text-gray-900 focus:ring-0" name="filter_price_min" placeholder="1.000 đ" type="number" value="{{ request()->input('filter_price_min') }}">
                                            </div>
                                            <span class="mx-4 text-gray-500">-</span>
                                            <div>
                                                <input class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-3 text-sm text-gray-900 focus:ring-0" name="filter_price_max" placeholder="100.000.000 đ" type="number" value="{{ request()->input('filter_price_max') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="flex items-center space-x-4 rounded-b p-6">
                                        <button class="button-red" type="submit">
                                            Lọc sản phẩm
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
                        <th class="px-4 py-3 text-left" scope="col">Tên</th>
                        <th class="px-4 py-3 text-left" scope="col">Ảnh</th>
                        <th class="px-4 py-3 text-center" scope="col">Giá</th>
                        <th class="px-4 py-3 text-center" scope="col">Số lượng</th>
                        <th class="px-4 py-3 text-center" scope="col">Danh mục</th>
                        <th class="px-4 py-3" scope="col">
                            <span class="sr-only">Hành động </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($toppings as $topping)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="w-4 px-4 py-3">
                                <div class="flex items-center">
                                    <input class="table-item-checkbox text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" id="table-item-checkbox-{{ $topping->id }}" onclick="event.stopPropagation()" type="checkbox" value="{{ $topping->id }}">
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-left text-gray-900">
                                <a class="hover:text-red-600 font-medium" href="{{ route('admin.toppings.edit', $topping) }}">
                                    {{ $topping->name }}
                                </a>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-center text-gray-900">
                                <a class="shrink-0" data-fslightbox="gallery" href="{{ asset('storage/uploads/toppings/' . $topping->image) }}">
                                    <img class="img-sm img-circle object-cover" loading="lazy" src="{{ asset('storage/uploads/toppings/' . $topping->image) }}">
                                </a>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-center text-gray-900">
                                {{ number_format($topping->price) }}₫
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-center text-gray-900">{{ $topping->quantity }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-center text-gray-900">
                                @foreach ($categories as $category)
                                    @if ($category->id == $topping->category_id)
                                        <span>{{ $category->name }}</span>
                                    @endif
                                @endforeach
                            </td>
                            <td class="flex items-center justify-end px-4 py-3">
                                <button class="inline-flex items-center rounded-lg p-0.5 text-center text-sm text-gray-500 hover:text-gray-800 focus:outline-none" data-dropdown-toggle="{{ $topping->id }}-dropdown" id="{{ $topping->id }}" type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow" id="{{ $topping->id }}-dropdown">
                                    <ul aria-labelledby="{{ $topping->id }}" class="py-1 text-sm text-gray-700">
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('admin.toppings.edit', $topping) }}">Cập nhật</a>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <a class="block cursor-pointer px-4 py-2 text-sm text-red-500 hover:bg-gray-100" data-modal-target="delete-modal-{{ $topping->id }}" data-modal-toggle="delete-modal-{{ $topping->id }}" href="#">Xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{-- start modal --}}
                        <div class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0" id="delete-modal-{{ $topping->id }}" tabindex="-1">
                            <div class="relative max-h-full w-full max-w-md p-4">
                                <div class="relative rounded-lg bg-white shadow">
                                    <button class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-hide="delete-modal-{{ $topping->id }}" type="button">
                                        @svg('tabler-x', 'w-4 h-4')
                                    </button>
                                    <div class="p-4 text-center md:p-5">
                                        <div class="flex justify-center">
                                            @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                        </div>
                                        <h3 class="mb-5 font-normal">Bạn có muốn xóa Topping này không?</h3>

                                        <form action="{{ route('admin.toppings.destroy', $topping->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300" type="submit">
                                                Xóa
                                            </button>
                                        </form>

                                        <button class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100" data-modal-hide="delete-modal-{{ $topping->id }}" type="button">Không</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal --}}
                    @empty
                        <td class="py-4 text-center text-base" colspan="6">
                            <div class="flex h-80 w-full flex-col items-center justify-center rounded-lg bg-white p-6">
                                @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                <p class="mt-4 text-sm text-gray-500">Dữ liệu trống</p>
                            </div>
                        </td>
                        <!-- Hiển thị "Trống" nếu không có dữ liệu -->
                    @endforelse
                </tbody>
            </table>
            <div class="p-4">
                {{ $toppings->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        tableCheckboxItem('table-checkbox-all', 'table-item-checkbox');
    </script>
@endsection
