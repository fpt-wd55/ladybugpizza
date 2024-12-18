@extends('layouts.admin')
@section('title', 'Thuộc tính | Thêm mới')
@section('content')
    {{ Breadcrumbs::render('admin.attributes.create') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Thêm thuộc tính</h3>
            <form action="{{ route('admin.attributes.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-1">
                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <div>
                            <label for="attribute_name" class="block mb-2 text-sm font-medium text-gray-900 ">Tên thuộc
                                tính <span class="text-red-500">*</span></label>
                            <input type="text" name="attribute_name" id="attribute_name" placeholder="VD: Loại đế"
                                   value="{{ old('attribute_name') }}" class="input">
                            @error('attribute_name')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div>
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 ">Danh mục
                                <span
                                    class="text-red-500">*</span></label>
                            <select class="select" name="category_id">
                                <option selected disabled>Chọn danh mục</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div>
                            <label for="status" class="block mb-4 text-sm font-medium text-gray-900 ">Trạng
                                thái</label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="status" class="sr-only peer" value="1"
                                    {{ old('status') ? 'checked' : '' }}>
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                </div>
                                <span class="ms-3 text-sm font-medium text-gray-900">Hoạt
                                    động</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <table id="example" class="table-auto w-full rounded-md table-add-more">
                            <thead>
                            <tr class="border">
                                <th colspan="3" class="px-4 py-2 text-start text-base font-medium">Thêm giá trị</th>
                                <th class="px-6 py-2 text-end">
                                    <a href="#" class="font-medium text-blue-600 hover:underline btn-add-more">+
                                        Thêm mới</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody id="table-body">
                            @php
                                $key = 0;
                            @endphp
                            @if (request()->old('stocks'))
                                @foreach (request()->old('stocks') as $key => $stock)
                                    <tr>
                                        <td class="border px-4 py-2" colspan="4">
                                            <div class="grid grid-cols-1 gap-3 md:grid-cols-7">
                                                <div class="md:col-span-2">
                                                    <input type="text"
                                                           name="stocks[{{ $key }}][attribute_value]"
                                                           placeholder="Tên giá trị"
                                                           value="{{ $stock['attribute_value'] ?? '' }}" class="input">
                                                    @error("stocks.{$key}.attribute_value")
                                                    <p class="mt-2 text-sm text-red-600 ">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="md:col-span-2">
                                                    <input type="number"
                                                           name="stocks[{{ $key }}][attribute_quantity]"
                                                           placeholder="Số lượng" min="0" max="9999"
                                                           value="{{ $stock['attribute_quantity'] ?? '' }}"
                                                           class="input">
                                                    @error("stocks.{$key}.attribute_quantity")
                                                    <p class="mt-2 text-sm text-red-600 ">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="md:col-span-2">
                                                    <div class="grid grid-cols-3">
                                                        <select
                                                            name="stocks[{{ $key }}][attribute_type_price]"
                                                            class="select">
                                                            <option value="1"
                                                                {{ isset($stock['attribute_type_price']) && $stock['attribute_type_price'] == 1 ? 'selected' : '' }}>
                                                                Theo giá tiền (₫)
                                                            </option>
                                                            <option value="2"
                                                                {{ isset($stock['attribute_type_price']) && $stock['attribute_type_price'] == 2 ? 'selected' : '' }}>
                                                                Theo phần trăm (%)
                                                            </option>
                                                        </select>
                                                        <input type="number"
                                                               name="stocks[{{ $key }}][attribute_price]" min="0"
                                                               value="{{ $stock['attribute_price'] ?? '' }}"
                                                               class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border focus:border-primary-600 border-gray-300 focus:ring-0 col-span-2"
                                                               placeholder="Giá"/>
                                                    </div>
                                                    @error("stocks.{$key}.attribute_price")
                                                    <p class="mt-2 text-sm text-red-600 ">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="md:col-span-1">
                                                    <button type="button"
                                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 btn-add-more-rm w-full">
                                                        Xóa giá trị
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="border px-4 py-2" colspan="4">
                                        <div class="grid grid-cols-1 gap-3 md:grid-cols-7">
                                            <div class="md:col-span-2">
                                                <input type="text" name="stocks[0][attribute_value]"
                                                       placeholder="Tên giá trị" class="input">
                                            </div>
                                            <div class="md:col-span-2">
                                                <input type="number" name="stocks[0][attribute_quantity]"
                                                       placeholder="Số lượng" min="0" max="9999" class="input">
                                            </div>
                                            <div class="md:col-span-2">
                                                <div class="grid grid-cols-3">
                                                    <select name="stocks[0][attribute_type_price]" class="select">
                                                        <option value="1">Theo giá tiền (₫)</option>
                                                        <option value="2" selected>Theo phần trăm (%)</option>
                                                    </select>
                                                    <input type="number" min="0" name="stocks[0][attribute_price]"
                                                           class="input col-span-2" placeholder="Giá"/>
                                                </div>
                                            </div>
                                            <div class="md:col-span-1">
                                                <button type="button"
                                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 btn-add-more-rm w-full">
                                                    Xóa giá trị
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-5">
                    <a href="{{ route('admin.attributes.index') }}" class="button-gray">
                        Quay lại
                    </a>
                    <button type="submit" class="button-blue">
                        Thêm thuộc tính
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let i = document.querySelectorAll('.table-add-more tbody tr').length;
            console.log(i);
            document.querySelector('.btn-add-more').addEventListener('click', function (e) {
                e.preventDefault();
                if (i >= 10) {
                    return;
                }
                i++;
                document.querySelector('.table-add-more tbody').insertAdjacentHTML('beforeend', `
                    <tr>
                        <td class="border px-4 py-2" colspan="4">
                            <div class="grid grid-cols-1 gap-3 md:grid-cols-7">
                                <div class="md:col-span-2">
                                    <input type="text" name="stocks[${i}][attribute_value]"
                                        placeholder="Tên giá trị"
                                        class="input">
                                </div>
                                <div class="md:col-span-2">
                                    <input type="number" name="stocks[${i}][attribute_quantity]"
                                        placeholder="Số lượng" min="0" max="9999"
                                        class="input">
                                </div>
                                <div class="md:col-span-2">
                                    <div class="grid grid-cols-3">
                                        <select name="stocks[${i}][attribute_type_price]"
                                            class="select">
                                            <option value="1">Theo giá tiền (₫)</option>
                                            <option value="2" selected>Theo phần trăm (%)</option>
                                        </select>
                                        <input type="number" name="stocks[${i}][attribute_price]"
                                            class="input col-span-2" min="0"
                                            placeholder="Giá" />
                                    </div>
                                </div>
                                <div class="md:col-span-1">
                                    <button type="button"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 btn-add-more-rm w-full">
                                        Xóa giá trị
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                `);
                updateRemoveButtons();
            });

            document.addEventListener('click', function (e) {
                if (e.target.closest('.btn-add-more-rm')) {
                    e.target.closest('tr').remove();
                    updateRemoveButtons();
                }
            });

            function updateRemoveButtons() {
                const rows = document.querySelectorAll('#table-body tr');
                const removeButtons = document.querySelectorAll('.btn-add-more-rm');
                if (rows.length === 1) {
                    removeButtons.forEach(button => button.disabled = true);
                } else {
                    removeButtons.forEach(button => button.disabled = false);
                }
            }

            updateRemoveButtons();
        });
    </script>
@endsection
