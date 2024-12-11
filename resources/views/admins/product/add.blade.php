@extends('layouts.admin')
@section('title', 'Sản phẩm | Thêm mới')
@section('content')
    {{ Breadcrumbs::render('admin.products.create') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Thêm sản phẩm</h3>
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    {{-- Anh san pham --}}
                    <div class="sm:col-span-2">
                        <div class="flex items-center justify-center w-full mb-4 ">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-20 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    @svg('tabler-cloud-upload', 'w-8 h-8 text-gray-400 mb-2')
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Nhấn để tải lên</span>
                                        hoặc kéo thả
                                        vào đây
                                    </p>
                                </div>
                                <input id="dropzone-file" name="image" type="file" class="hidden" />
                            </label>
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    {{-- Thong tin co ban --}}
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Tên sản
                                    phẩm <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" placeholder="VD: Pizza hải sản"
                                    value="{{ old('name') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 ">Mã sản
                                    phẩm <span class="text-red-500">*</span></label>
                                <input type="text" name="sku" id="sku" placeholder="VD: YSU4247641"
                                    value="{{ old('sku') }}" maxlength="15"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('sku')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 ">Danh
                                    mục <span class="text-red-500">*</span></label>
                                <select id="category_id" name="category_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <option value="" {{ old('category_id') ? '' : 'selected' }} disabled>
                                        Chọn danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            data-has-attribute="{{ count($category->attributes) }}"
                                            data-has-daily-quantity="{{ $category->is_resettable }}"
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
                        </div>
                    </div>
                    {{-- Gia va so luong --}}
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-4">
                            <div>
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Giá bán thường
                                    (₫) <span class="text-red-500">*</span></label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}"
                                    placeholder="VD: 100000"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('price')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="discount_price" class="block mb-2 text-sm font-medium text-gray-900 ">Giá khuyến
                                    mãi (₫) <span class="text-red-500">*</span></label>
                                <input type="number" name="discount_price" id="discount_price" placeholder="VD: 80000"
                                    value="{{ old('discount_price') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('discount_price')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div id="quantity"></div>
                            <div id="daily_quantity"></div>
                        </div>
                    </div>
                    {{-- Trang thai --}}
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
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
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="is_featured" class="block mb-4 text-sm font-medium text-gray-900 opacity-0">Sản
                                    phẩm nổi bật</label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_featured" class="sr-only peer" value="1"
                                        {{ old('is_featured') ? 'checked' : '' }}>
                                    <div
                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                    </div>
                                    <span class="ms-3 text-sm font-medium text-gray-900">Sản phẩm nổi
                                        bật</span>
                                </label>
                                @error('is_featured')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- Mo ta san pham --}}
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Mô tả sản
                            phẩm <span class="text-red-500">*</span></label>
                        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50">
                            <textarea id="wysiwygeditor" name="description">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                {{-- Submit or cancel --}}
                <div class="flex items-center space-x-4 mt-5">
                    <a href="{{ route('admin.products.index') }}" class="button-gray">
                        Quay lại
                    </a>
                    <button type="submit" class="button-blue">
                        Thêm sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const category_id = document.getElementById('category_id');
            const quantity = document.getElementById('quantity');
            const daily_quantity = document.getElementById('daily_quantity');
            const checkHasAttribute = (hasAttribute, hasDailyQuantity) => {
                if (hasDailyQuantity == 1) {
                    if (hasAttribute == 0) {
                        quantity.innerHTML = `
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 ">Số
                            lượng <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="quantity" value="{{ old('quantity') ?? 0 }}"
                            placeholder="Số lượng"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    `;
                        daily_quantity.innerHTML = `
                        <label for="daily_quantity" class="block mb-2 text-sm font-medium text-gray-900 ">Số
                            lượng hàng ngày <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="daily_quantity" value="{{ old('daily_quantity') ?? 0 }}"
                            placeholder="Số lượng hàng ngày"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('daily_quantity')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    `;
                    } else {
                        quantity.innerHTML = '';
                        daily_quantity.innerHTML = '';
                    }
                } else {
                    daily_quantity.innerHTML = '';
                    if (hasAttribute == 0) {
                        quantity.innerHTML = `
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 ">Số
                            lượng <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="quantity" value="{{ old('quantity') ?? 0 }}"
                            placeholder="Số lượng"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    `;
                    } else {
                        quantity.innerHTML = '';
                    }
                }
            }
            const handleCategoryChange = () => {
                const selectedOption = category_id.options[category_id.selectedIndex];
                const hasAttribute = selectedOption.getAttribute('data-has-attribute');
                const hasDailyQuantity = selectedOption.getAttribute('data-has-daily-quantity');
                checkHasAttribute(hasAttribute, hasDailyQuantity);
            };

            category_id.addEventListener('change', handleCategoryChange);

            handleCategoryChange();
        });
    </script>

    <script></script>
@endsection
