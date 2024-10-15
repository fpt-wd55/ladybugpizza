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
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 sm:grid-cols-3">
                            <div class="sm:col-span-3">
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div class="sm:col-span-2">
                                        <div class="grid gap-4 mb-4 sm:grid-cols-12">
                                            <img loading="lazy" class="w-20 h-20 rounded-md"
                                                src="http://127.0.0.1:8000/storage/uploads/avatars/user-default.png">
                                            <div class="flex items-center justify-center w-full col-span-5">
                                                <label for="dropzone-file"
                                                    class="flex flex-col items-center justify-center w-full h-20 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                                    <div class="flex flex-col items-center justify-center">
                                                        @svg('tabler-cloud-upload', 'w-8 h-8 text-gray-400 mb-2')
                                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                                class="font-semibold">Nhấn để tải lên</span> hoặc kéo thả
                                                            vào đây
                                                        </p>
                                                    </div>
                                                    <input id="dropzone-file" name="image" type="file"
                                                        class="hidden" />
                                                </label>
                                                @error('image')
                                                    <p class="mt-2 text-sm text-red-600 ">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Tên sản
                                    phẩm</label>
                                <input type="text" name="name" id="name" placeholder="Tên sản phẩm"
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
                                    phẩm</label>
                                <input type="text" name="sku" id="sku" placeholder="Mã sản phẩm"
                                    value="{{ old('sku') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('sku')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 ">Danh
                                    mục</label>
                                <select id="category_id" name="category_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <option selected disabled>Danh mục</option>
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
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 ">Số
                                    lượng</label>
                                <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}"
                                    placeholder="Số lượng"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('quantity')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Giá bán thường
                                    (đ)</label>
                                <input type="text" name="price" id="price" value="{{ old('price') }}"
                                    placeholder="Giá bán thường"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('price')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="discount_price" class="block mb-2 text-sm font-medium text-gray-900 ">Giá khuyến
                                    mãi (đ)</label>
                                <input type="text" name="discount_price" id="discount_price" placeholder="Giá khuyến mãi"
                                    value="{{ old('discount_price') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('discount_price')
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
                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Hoạt
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
                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Sản phẩm nổi
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
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Mô tả sản
                            phẩm</label>
                        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50">
                            <textarea id="wysiwygeditor" name="description"></textarea>
                        </div>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>
                <div class="flex items-center space-x-4 mt-5">
                    <a href="{{ route('admin.products.index') }}" class="button-dark">
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
