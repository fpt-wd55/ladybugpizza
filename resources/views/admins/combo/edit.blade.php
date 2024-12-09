@extends('layouts.admin')
@section('title', 'Combo | Cập nhật')
@section('content')
    {{ Breadcrumbs::render('admin.combos.edit', $combo) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Cập nhật combo</h3>
            <form action="{{ route('admin.combos.update', $combo) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-2 sm:grid-cols-1">
                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Tên
                                combo <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name"
                                placeholder="VD: Mua 1 Tặng 1 - Tiết Kiệm Nhân Đôi" value="{{ old('name', $combo->name) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 ">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Giá bán thường
                                (₫) <span class="text-red-500">*</span></label>
                            <input type="number" name="price" id="price" value="{{ old('price', $combo->price) }}"
                                placeholder="VD: 300000" min="0"
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
                            <input type="number" name="discount_price" id="discount_price" placeholder="VD: 270000"
                                value="{{ old('discount_price', $combo->discount_price) }}" min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('discount_price')
                                <p class="mt-2 text-sm text-red-600 ">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="is_featured" class="block mb-2 text-sm font-medium text-gray-900 ">Ảnh combo <span
                                    class="text-red-500">*</span></label>
                            <div class="flex gap-3">
                                <a class="shrink-0" data-fslightbox="gallery"
                                    href="{{ asset('storage/uploads/combos/' . $combo->image) }}">
                                    <img loading="lazy" class="w-20 h-20 rounded-md object-cover"
                                        src="{{ asset('storage/uploads/combos/' . $combo->image) }}"
                                        onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'">
                                </a>
                                <div class="flex items-center justify-center w-full mb-4 ">
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
                                        <input id="dropzone-file" name="image" type="file" class="hidden" />
                                    </label>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600 ">
                                    {{ $message }}
                                </p>
                            @enderror
                            <div>
                                <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 ">Số lượng <span
                                        class="text-red-500">*</span></label>
                                <input type="number" name="quantity" id="quantity"
                                    value="{{ old('quantity', $combo->quantity) }}" placeholder="VD: 12" min="0"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('quantity')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 ">Mã combo <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="sku" id="sku" value="{{ old('sku', $combo->sku) }}"
                                    placeholder="VD: ZDZ9316939"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('sku')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="sm:grid grid-cols-2 grid gap-4 mb-4 ">
                                <div class="mt-3">
                                    <label for="status" class="block mb-4 text-sm font-medium text-gray-900 ">Trạng
                                        thái</label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="status" class="sr-only peer" value="1"
                                            {{ old('status', $combo->status) == 1 ? 'checked' : '' }}>
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
                                <div class="mt-3">
                                    <label for="is_featured" class="block mb-4 text-sm font-medium text-gray-900 ">Combo nổi
                                        bật</label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_featured" class="sr-only peer" value="1"
                                            {{ old('is_featured', $combo->is_featured) == 1 ? 'checked' : '' }}>
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900">Combo nổi bật</span>
                                    </label>
                                    @error('is_featured')
                                        <p class="mt-2 text-sm text-red-600 ">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="is_featured" class="block mb-2 text-sm font-medium text-gray-900 ">Mô tả <span
                                    class="text-red-500">*</span></label>
                            <div class="w-full border border-gray-200 rounded-lg bg-gray-50">
                                <textarea id="wysiwygeditor" name="description">{{ old('description', $combo->description) }}</textarea>
                            </div>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600 ">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-5">
                    <a href="{{ route('admin.combos.index') }}" class="button-gray">
                        Quay lại
                    </a>
                    <button type="submit" class="button-blue">
                        Cập nhật combo
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
