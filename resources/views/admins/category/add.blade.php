@extends('layouts.admin')
@section('title', 'Danh mục | Thêm mới')
@section('content')
    {{ Breadcrumbs::render('admin.categories.create') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Thêm danh mục</h3>
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="sm:col-span-2">
                    <label for="image" class="label-md">Hình ảnh danh mục <span class="text-red-500">*</span></label>
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
                        <p class="my-2 text-sm text-red-600 ">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="label-md">Tên danh mục <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="input"
                            placeholder="Ví dụ: Pizza">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
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
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.categories.index') }}">
                        <button type="button" class="rounded-lg button-gray">Quay Lại</button>
                    </a>
                    <button type="submit" class=" rounded-lg button-blue">
                        Thêm danh mục
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
