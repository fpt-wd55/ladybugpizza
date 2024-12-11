@extends('layouts.admin')
@section('title', 'Danh mục | Thêm mới')
@section('content')
    {{ Breadcrumbs::render('admin.categories.create') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Thêm danh mục</h3>
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-base font-medium text-gray-900 ">Hình ảnh danh mục <span
                                class="text-red-500">*</span></label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                            id="image" name="image" type="file">
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-base font-medium text-gray-900 ">Tên danh mục <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Ví dụ: Pizza">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="status-toggle" class="block mb-2 text-base font-medium text-gray-900 ">Trạng thái</label>
                        <div class="flex items-center">
                            <label for="status-toggle" class="inline-flex relative items-center cursor-pointer">
                                <input type="checkbox" id="status-toggle" name="status" class="sr-only peer"
                                    value="1">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                                </div>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label for="is_resettable-toggle" class="block mb-2 text-base font-medium text-gray-900 ">Làm mới hàng ngày</label>
                        <div class="flex items-center">
                            <label for="is_resettable-toggle" class="inline-flex relative items-center cursor-pointer">
                                <input type="checkbox" id="is_resettable-toggle" name="is_resettable" class="sr-only peer"
                                    value="1">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                                </div>
                            </label>
                        </div>
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
