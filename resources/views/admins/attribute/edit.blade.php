@extends('layouts.admin')
@section('title', 'Thuộc tính | Cập nhật thuộc tính')
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
                                tính</label>
                            <input type="text" name="attribute_name" id="attribute_name" placeholder="Tên thuộc tính"
                                value="{{ old('attribute_name', $attribute->name) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('attribute_name')
                                <p class="mt-2 text-sm text-red-600 ">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 ">Danh mục</label>
                            <select class="w-full h-10 mb-2 select" name="category_id">
                                <option selected disabled>Danh mục</option>
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
                            <label for="status" class="block mb-4 text-sm font-medium text-gray-900 ">Trạng
                                thái</label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="status" class="sr-only peer" value="1"
                                    {{ old('status', $attribute->status) ? 'checked' : '' }}>
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                </div>
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Hoạt
                                    động</span>
                            </label>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600 ">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Danh sách giá trị</th>
                                </tr>
                            </thead>
                            <tbody data-accordion="open">
                                @forelse ($attribute->values as $value)
                                    <tr class="border-b">
                                        <td class="border px-4 py-2" colspan="3">
                                            <div class="grid grid-cols-1 gap-3 md:grid-cols-6">
                                                <input type="hidden" name="old_stocks[{{ $value->id }}][id]"
                                                    value="{{ $value->id }}">
                                                <div class="md:col-span-3">
                                                    <input type="text" name="old_stocks[{{ $value->id }}][value]"
                                                        placeholder="Tên giá trị" value="{{ $value->value }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                    @error("old_stocks.{$value->id}.value")
                                                        <p class="mt-2 text-sm text-red-600 ">
                                                            {{ $message }}
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="md:col-span-2">
                                                    <input type="number" name="old_stocks[{{ $value->id }}][quantity]"
                                                        placeholder="Số lượng" value="{{ $value->quantity }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                    @error("old_stocks.{$value->id}.quantity")
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
                        <tbody>
                            @php
                                $key = 0;
                            @endphp
                            @if (request()->old('stocks'))
                                @foreach (request()->old('stocks') as $key => $stock)
                                    <tr>
                                        <td class="border px-4 py-2" colspan="3">
                                            <div class="grid grid-cols-1 gap-3 md:grid-cols-6">
                                                <div class="md:col-span-3">
                                                    <input type="text"
                                                        name="stocks[{{ $key }}][attribute_value]"
                                                        placeholder="Tên giá trị"
                                                        value="{{ $stock['attribute_value'] ?? '' }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                    @error("stocks.{$key}.attribute_value")
                                                        <p class="mt-2 text-sm text-red-600 ">
                                                            {{ $message }}
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="md:col-span-2">
                                                    <input type="number"
                                                        name="stocks[{{ $key }}][attribute_quantity]"
                                                        placeholder="Số lượng"
                                                        value="{{ $stock['attribute_quantity'] ?? '' }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                    @error("stocks.{$key}.attribute_quantity")
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
        document.addEventListener('DOMContentLoaded', function() {
            let i = parseInt(document.querySelector('meta[name="key"]')?.getAttribute('content') || 0, 10);

            document.querySelector('.btn-add-more').addEventListener('click', function(e) {
                e.preventDefault();
                i++;
                document.querySelector('.table-add-more tbody').insertAdjacentHTML('beforeend', `
                    <tr>
                        <td class="border px-4 py-2" colspan="3">
                            <div class="grid grid-cols-1 gap-3 md:grid-cols-6">
                                <div class="md:col-span-3">
                                    <input type="text" name="stocks[${i}][attribute_value]"
                                        placeholder="Tên giá trị"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                </div>
                                <div class="md:col-span-2">
                                    <input type="number" name="stocks[${i}][attribute_quantity]"
                                        placeholder="Số lượng"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
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

            document.addEventListener('click', function(e) {
                if (e.target.closest('.btn-add-more-rm')) {
                    e.target.closest('tr').remove();
                }
            });
        });
    </script>
@endsection
