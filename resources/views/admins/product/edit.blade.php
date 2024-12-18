@extends('layouts.admin')
@section('title', 'Sản phẩm | Cập nhật')
@section('content')
    {{ Breadcrumbs::render('admin.products.edit', $product) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Cập nhật sản phẩm</h3>
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label for="image" class="label-md">Hình ảnh sản phẩm <span class="text-red-500">*</span></label>
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    {{-- Anh san pham --}}
                    <div class="sm:col-span-2">
                        <div class="flex gap-3">
                            <a class="shrink-0" data-fslightbox="gallery"
                               href="{{ asset('storage/uploads/products/' . $product->image) }}">
                                <img loading="lazy" class="w-20 h-20 rounded-md object-cover"
                                     src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                     onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'">
                            </a>
                            <div class="flex items-center justify-center w-full mb-4">
                                <label for="dropzone-file"
                                       class="flex flex-col items-center justify-center w-full h-20 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        @svg('tabler-cloud-upload', 'w-8 h-8 text-gray-400 mb-2')
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Nhấn để tải
                                                lên</span>
                                            hoặc kéo thả
                                            vào đây
                                        </p>
                                    </div>
                                    <input id="dropzone-file" name="image" type="file" class="hidden"/>
                                </label>
                            </div>
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
                                <label for="name" class="label-md">Tên sản
                                    phẩm <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" placeholder="VD: Pizza hải sản"
                                       value="{{ old('name', $product->name) }}" class="input">
                                @error('name')
                                <p class="mt-2 text-sm text-red-600 ">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div>
                                <label for="sku" class="label-md">Mã sản
                                    phẩm <span class="text-red-500">*</span></label>
                                <input type="text" name="sku" id="sku" placeholder="VD: YSU4247641"
                                       value="{{ old('sku', $product->sku) }}" maxlength="15" class="input">
                                @error('sku')
                                <p class="mt-2 text-sm text-red-600 ">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div>
                                <label for="category_id" class="label-md">Danh
                                    mục <span class="text-red-500">*</span></label>
                                <select id="category_id" name="category_id" class="select">
                                    <option value="" {{ old('category_id') ? '' : 'selected' }} disabled>
                                        Danh mục
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                                data-has-attribute="{{ count($category->attributes) }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label for="price" class="label-md">Giá bán thường
                                    (₫) <span class="text-red-500">*</span></label>
                                <input type="number" name="price" id="price" min="0"
                                       value="{{ old('price', $product->price) }}" placeholder="VD: 100000"
                                       class="input">
                                @error('price')
                                <p class="mt-2 text-sm text-red-600 ">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div>
                                <label for="discount_price" class="label-md">Giá khuyến
                                    mãi (₫) <span class="text-red-500">*</span></label>
                                <input type="number" name="discount_price" id="discount_price" placeholder="VD: 80000"
                                       min="0"
                                       value="{{ old('discount_price', $product->discount_price) }}" class="input">
                                @error('discount_price')
                                <p class="mt-2 text-sm text-red-600 ">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div id="quantity"></div>
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
                                        {{ old('status', $product->status) == 1 ? 'checked' : '' }}>
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
                                        {{ old('is_featured', $product->is_featured) == 1 ? 'checked' : '' }}>
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
                        <label for="description" class="label-md">Mô tả sản
                            phẩm <span class="text-red-500">*</span></label>
                        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50">
                            <textarea id="wysiwygeditor"
                                      name="description">{{ old('description', $product->description) }}</textarea>
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
                        Cập nhật sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const category_id = document.getElementById('category_id');
            const quantity = document.getElementById('quantity');
            const checkHasAttribute = (hasAttribute) => {
                if (hasAttribute == 0) {
                    quantity.innerHTML = `
                        <label for="quantity" class="label-md">Số
                            lượng <span class="text-red-500">*</span></label>
                        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) ?? 0 }}"
                            placeholder="Số lượng" min="0" max="9999"
                            class="input">
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

            const handleCategoryChange = () => {
                const selectedOption = category_id.options[category_id.selectedIndex];
                const hasAttribute = selectedOption.getAttribute('data-has-attribute');
                checkHasAttribute(hasAttribute);
            };

            category_id.addEventListener('change', handleCategoryChange);

            handleCategoryChange();
        });
    </script>
@endsection
