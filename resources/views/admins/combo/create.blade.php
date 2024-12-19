@extends('layouts.admin')
@section('title', 'Combo | Thêm mới')
@section('content')
    {{ Breadcrumbs::render('admin.combos.create') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Thêm combo</h3>
            <form action="{{ route('admin.combos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-1">
                    <div class="grid gap-4 mb-2 sm:grid-cols-3">
                        <div>
                            <label for="name" class="label-md">Tên
                                combo <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name"
                                   placeholder="VD: Mua 1 Tặng 1 - Tiết Kiệm Nhân Đôi" value="{{ old('name') }}"
                                   class="input">
                            @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div>
                            <label for="price" class="label-md">Giá bán thường
                                (₫) <span class="text-red-500">*</span></label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}"
                                   placeholder="VD: 300000" min="0" class="input">
                            @error('price')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div>
                            <label for="discount_price" class="label-md">Giá khuyến
                                mãi (₫) <span class="text-red-500">*</span></label>
                            <input type="number" name="discount_price" id="discount_price" placeholder="VD: 270000"
                                   value="{{ old('discount_price') }}" min="0" class="input">
                            @error('discount_price')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <div>
                                <label for="is_featured" class="label-md">Ảnh combo
                                    <span class="text-red-500">*</span></label>
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
                                @error('image')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div>
                                <label for="quantity" class="label-md">Số lượng <span
                                        class="text-red-500">*</span></label>
                                <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" min="0"
                                       max="9999"
                                       placeholder="VD: 12" class="input">
                                @error('quantity')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="sku" class="label-md">Mã combo <span class="text-red-500">*</span></label>
                                <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                                       placeholder="VD: ZDZ9316939" class="input">
                                @error('sku')
                                <p class="mt-2 text-sm text-red-600">
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
                                            {{ old('status') ? 'checked' : '' }}>
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900">Hoạt
                                            động</span>
                                    </label>
                                    @error('status')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="is_featured" class="block mb-4 text-sm font-medium text-gray-900 ">Combo
                                        nổi
                                        bật</label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_featured" class="sr-only peer" value="1"
                                            {{ old('is_featured') ? 'checked' : '' }}>
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900">Combo nổi bật</span>
                                    </label>
                                    @error('is_featured')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="is_featured" class="label-md">Mô tả <span class="text-red-500">*</span></label>
                            <div class="w-full border border-gray-200 rounded-lg bg-gray-50">
                                <textarea id="wysiwygeditor" name="description">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                            <p class="mt-2 text-sm text-red-600">
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
                        Thêm combo
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
