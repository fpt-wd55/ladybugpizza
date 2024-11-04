@extends('layouts.admin')
@section('title', 'Trang | Thêm mới')
@section('content')
    {{ Breadcrumbs::render('admin.pages.create') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Thêm mới trang</h3>
            <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            {{-- tieu de --}}
                            <div>
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">Tiêu đề</label>
                                <input type="text" name="title" id="title" placeholder="Tiêu đề"
                                    value="{{ old('title') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('title')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            {{-- đường dẫn --}}
                            <div>
                                <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 ">Đường
                                    dẫn</label>
                                <input type="text" name="slug" id="slug" placeholder="Đường dẫn"
                                    value="{{ old('slug') }}" maxlength="15"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('slug')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- Trang thai --}}
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
                    {{-- Noi dung --}}
                    <div class="sm:col-span-2">
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Nội dung</label>
                        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50">
                            <textarea id="wysiwygeditor" name="content">{{ old('content') }}</textarea>
                        </div>
                        @error('content')
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
                        Thêm trang
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
{{-- @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const category_id = document.getElementById('category_id');
            const quantity = document.getElementById('quantity');
            const checkHasAttribute = (hasAttribute) => {
                if (hasAttribute == 0) {
                    quantity.innerHTML = `
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 ">Số
                            lượng</label>
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

            const handleCategoryChange = () => {
                const selectedOption = category_id.options[category_id.selectedIndex];
                const hasAttribute = selectedOption.getAttribute('data-has-attribute');
                checkHasAttribute(hasAttribute);
            };

            category_id.addEventListener('change', handleCategoryChange);

            handleCategoryChange();
        });
    </script>
@endsection --}}
