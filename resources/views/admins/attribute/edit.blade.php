@extends('layouts.admin')
@section('title', 'Thuộc tính | Cập nhật')
@section('content')
    {{ Breadcrumbs::render('admin.attributes.edit', $attribute) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Cập nhật thuộc tính</h3>
            <form action="{{ route('admin.attributes.update', $attribute) }}" method="post">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 sm:grid-cols-1">
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div>
                            <label for="attribute_name" class="block mb-2 text-sm font-medium text-gray-900 ">Tên thuộc
                                tính <span class="text-red-500">*</span></label>
                            <input type="text" name="attribute_name" id="attribute_name" placeholder="VD: Loại đế"
                                   value="{{ old('attribute_name', $attribute->name) }}" class="input">
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
                                        {{ old('category_id', $attribute->category_id) == $category->id ? 'selected' : '' }}>
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
                            <label class="mb-4 block text-sm font-medium text-gray-900" for="status">Trạng
                                thái</label>
                            <label class="inline-flex cursor-pointer items-center">
                                <input
                                    {{ old('status', $attribute->status) == 1 ? 'checked' : '' }} class="peer sr-only"
                                    name="status" type="checkbox" value="1">
                                <div
                                    class="peer relative h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-0 rtl:peer-checked:after:-translate-x-full">
                                </div>
                                <span class="ms-3 text-sm font-medium text-gray-900">Hoạt
                                    động</span>
                            </label>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">Danh sách giá trị</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($attribute->values as $value)
                                <tr class="border-b">
                                    <td class="border px-4 py-2" colspan="4">
                                        <div class="grid grid-cols-1 gap-3 md:grid-cols-7">
                                            <input type="hidden" name="old_stocks[{{ $value->id }}][id]"
                                                   value="{{ $value->id }}">
                                            <div class="md:col-span-2">
                                                <input type="text"
                                                       name="old_stocks[{{ $value->id }}][attribute_value]"
                                                       placeholder="Tên giá trị" value="{{ $value->value }}"
                                                       class="input">
                                                @error("old_stocks.{$value->id}.attribute_value")
                                                <p class="mt-2 text-sm text-red-600 ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="md:col-span-2">
                                                <input type="number"
                                                       name="old_stocks[{{ $value->id }}][attribute_quantity]" min="0"
                                                       max="9999"
                                                       placeholder="Số lượng" value="{{ $value->quantity }}"
                                                       class="input">
                                                @error("old_stocks.{$value->id}.attribute_quantity")
                                                <p class="mt-2 text-sm text-red-600 ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="md:col-span-2">
                                                <div class="grid grid-cols-3">
                                                    <select
                                                        name="old_stocks[{{ $value->id }}][attribute_type_price]"
                                                        class="select">
                                                        <option value="1"
                                                            {{ $value->price_type == 1 ? 'selected' : '' }}>
                                                            Theo giá tiền (₫)
                                                        </option>
                                                        <option value="2"
                                                            {{ $value->price_type == 2 ? 'selected' : '' }}>
                                                            Theo phần trăm (%)
                                                        </option>
                                                    </select>
                                                    <input type="number" min="0"
                                                           name="old_stocks[{{ $value->id }}][attribute_price]"
                                                           value="{{ $value->price }}" class="input col-span-2"
                                                           placeholder="Giá"/>
                                                </div>
                                                @error("old_stocks.{$value->id}.attribute_price")
                                                <p class="mt-2 text-sm text-red-600 ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="md:col-span-1 flex items-center">
                                                <button
                                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 btn-add-more-rm w-full">
                                                    Xóa giá trị
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <!-- Hiển thị "Trống" nếu không có dữ liệu -->
                                <td colspan="6" class="text-center py-4 text-base">
                                    <div
                                        class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
                                        @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                        <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                                    </div>
                                </td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="my-5">
                    <table id="example" class="table-auto w-full rounded-md table-add-more">
                        <thead>
                        <tr class="border">
                            <th colspan="2" class="px-4 py-2 text-start text-base font-medium">Thêm giá trị</th>
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
                                                <input type="number" min="0" max="9999"
                                                       name="stocks[{{ $key }}][attribute_quantity]"
                                                       placeholder="Số lượng"
                                                       value="{{ $stock['attribute_quantity'] ?? '' }}" class="input">
                                                @error("stocks.{$key}.attribute_quantity")
                                                <p class="mt-2 text-sm text-red-600 ">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="md:col-span-2">
                                                <div class="grid grid-cols-3">
                                                    <select name="stocks[{{ $key }}][attribute_type_price]"
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
                                                    <input type="number" min="0"
                                                           name="stocks[{{ $key }}][attribute_price]"
                                                           value="{{ $stock['attribute_price'] ?? '' }}"
                                                           class="input col-span-2" placeholder="Giá"/>
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
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="flex items-center space-x-4 mt-5">
                    <a href="{{ route('admin.attributes.index') }}" class="button-gray">
                        Quay lại
                    </a>
                    <button type="submit" class="button-blue">
                        Cập nhật thuộc tính
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
            document.querySelector('.btn-add-more').addEventListener('click', function (e) {
                e.preventDefault();
                if (i >= 5) {
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
                                    <input type="number" name="stocks[${i}][attribute_quantity]" min="0" max="9999"
                                        placeholder="Số lượng"
                                        class="input">
                                </div>
                                <div class="md:col-span-2">
                                    <div class="grid grid-cols-3">
                                        <select name="stocks[${i}][attribute_type_price]"
                                            class="select">
                                            <option value="1">Theo giá tiền (₫)</option>
                                            <option value="2" selected>Theo phần trăm (%)</option>
                                        </select>
                                        <input type="number" name="stocks[${i}][attribute_price]" min="0"
                                            class="input col-span-2"
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
            });

            document.addEventListener('click', function (e) {
                if (e.target.closest('.btn-add-more-rm')) {
                    e.target.closest('tr').remove();
                }
            });
        });
    </script>
@endsection
