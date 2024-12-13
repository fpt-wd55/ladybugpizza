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
                <div class="sm:col-span-2">
                    <label for="image" class="block mb-2 text-base font-medium text-gray-900 ">Hình ảnh danh mục <span
                            class="text-red-500">*</span></label>
                    <div class="flex gap-3">
                        <a class="shrink-0" data-fslightbox="gallery"
                            href="{{ asset('storage/uploads/categories/' . $category->image) }}">
                            <img loading="lazy" class="w-20 h-20 rounded-md object-cover"
                                src="{{ asset('storage/uploads/categories/' . $category->image) }}">
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
                                <input id="dropzone-file" name="image" type="file" class="hidden" />
                            </label>
                        </div>
                    </div>
                    @error('image')
                        <p class="my-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-base font-medium text-gray-900 ">Tên danh mục <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ $category->name }}"
                            placeholder="Ví dụ: Pizza" class="input">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-4 block text-sm font-medium text-gray-900" for="status">Trạng
                            thái</label>
                        <label class="inline-flex cursor-pointer items-center">
                            <input {{ old('status', $category->status) == 1 ? 'checked' : '' }} class="peer sr-only"
                                name="status" type="checkbox" value="1">
                            <div
                                class="peer relative h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-0 rtl:peer-checked:after:-translate-x-full">
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
