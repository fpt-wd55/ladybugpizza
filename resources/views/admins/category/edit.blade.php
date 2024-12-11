@extends('layouts.admin')
@section('title', 'Danh mục | Cập nhật')
@section('content')
    {{ Breadcrumbs::render('admin.categories.edit', $category) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Cập nhật danh mục</h3>
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-base font-medium text-gray-900 ">Hình ảnh danh mục <span
                                class="text-red-500">*</span></label>
                        <div class="flex items-center text-gray-900 whitespace-nowrap ">
                            <a class="shrink-0" data-fslightbox="gallery"
                                href="{{ asset('storage/uploads/categories/' . $category->image) }}">
                                <img loading="lazy" src="{{ asset('storage/uploads/categories/' . $category->image) }}"
                                    class="w-10 h-10 mr-3 rounded object-cover">
                            </a>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                id="image" name="image" type="file">
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600"><span class="font-medium">Lỗi! </span>
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-base font-medium text-gray-900 ">Tên danh mục <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ $category->name }}"
                            placeholder="Ví dụ: Pizza"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600"><span class="font-medium">Lỗi! </span>
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="">
                        <label for="name" class="block mb-2 text-base font-medium text-gray-900 ">Trạng thái</label>
                        <div class="flex items-center">
                            <label for="status-toggle" class="inline-flex relative items-center cursor-pointer">
                                <input type="checkbox" id="status-toggle" name="status" class="sr-only peer"
                                    {{ $category->status == 1 ? 'checked' : '' }} value="1">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                                </div>

                            </label>
                        </div>
                    </div>
                    <div>
                        <label for="is_resettable" class="block mb-2 text-base font-medium text-gray-900 ">Làm mới hàng
                            ngày</label>
                        <div class="flex items-center">
                            <label for="is_resettable-toggle" class="inline-flex relative items-center cursor-pointer">
                                <input type="checkbox" id="is_resettable-toggle" name="is_resettable" class="sr-only peer"
                                    {{ $category->is_resettable == 1 ? 'checked' : '' }} value="1">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.categories.index') }}">
                        <button type="button" class="rounded-lg button-gray">
                            Quay Lại
                        </button>
                    </a>
                    <button type="submit" class=" rounded-lg button-blue">
                        Cập nhật danh mục
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
