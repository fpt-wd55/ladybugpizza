@extends('layouts.admin')

@section('title', 'Trang | Cập nhật')

@section('content')
    {{ Breadcrumbs::render('admin.pages.edit') }}
    <div class="relative mt-5 overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="mx-auto p-4">
            <h3 class="mb-4 text-lg font-bold text-gray-900">Cập nhật trang</h3>
            <form action="{{ route('admin.pages.update', $page) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4 grid gap-4 sm:grid-cols-3">
                    <div class="sm:col-span-3">
                        <div class="mb-4 grid gap-4 sm:grid-cols-3">
                            <div>
                                <label class="label-md" for="title">Tiêu đề trang <span class="text-red-500">*</span></label>
                                <input class="input" id="title" name="title" placeholder="VD: Giới thiệu" type="text" value="{{ $page->title }}">
                                @error('title')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="label-md" for="slug">Đường dẫn trang <span class="text-red-500">*</span></label>
                                <input class="input" id="slug" maxlength="15" name="slug" placeholder="VD: gioi-thieu" type="text" value="{{ $page->slug }}">
                                @error('slug')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            @if ($page->type == 2)
                                <div>
                                    <label class="mb-4 block text-sm font-medium text-gray-900" for="status">Trạng thái</label>
                                    <label class="inline-flex cursor-pointer items-center">
                                        <input {{ old('status', $page->status) ? 'checked' : '' }} class="peer sr-only" name="status" type="checkbox" value="1">
                                        <div class="peer relative h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-0 rtl:peer-checked:after:-translate-x-full">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900">Hoạt động</span>
                                    </label>
                                    @error('status')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @else
                                <input hidden name="status" type="text" value="1">
                            @endif
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label class="label-md" for="content">Nội dung <span class="text-red-500">*</span></label>
                        <div class="mb-4 w-full rounded-lg border border-gray-200 bg-gray-50">
                            <textarea id="wysiwygeditor" name="content">{{ $page->content }}</textarea>
                        </div>
                        @error('content')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="mt-5 flex items-center space-x-4">
                    <a class="button-gray" href="{{ route('admin.pages.index') }}">
                        Quay lại
                    </a>
                    <button class="button-blue" type="submit">
                        Cập nhật trang
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
@endsection --}}
