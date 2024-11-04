@extends('layouts.admin')
@section('title', 'Combo | Thêm combo')
@section('content')
    {{ Breadcrumbs::render('admin.combos.create') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Thêm combo</h3>
            <form action="{{ route('admin.combos.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-1">
                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <div>
                            <label for="attribute_name" class="block mb-2 text-sm font-medium text-gray-900 ">Tên
                                combo</label>
                            <input type="text" name="attribute_name" id="attribute_name" placeholder="Tên thuộc tính"
                                value="{{ old('attribute_name') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('attribute_name')
                                <p class="mt-2 text-sm text-red-600 ">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Giá bán thường
                                (₫)</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}"
                                placeholder="Giá bán thường" min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('price')
                                <p class="mt-2 text-sm text-red-600 ">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="discount_price" class="block mb-2 text-sm font-medium text-gray-900 ">Giá khuyến
                                mãi (₫)</label>
                            <input type="number" name="discount_price" id="discount_price" placeholder="Giá khuyến mãi"
                                value="{{ old('discount_price') }}" min="0"
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
                            <div>
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
                                @error('image')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Số lượng</label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}"
                                    placeholder="Số lượng" min="0"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('price')
                                    <p class="mt-2 text-sm text-red-600 ">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Mã combo</label>
                                <input type="text" name="price" id="price" value="{{ old('price') }}"
                                    placeholder="Mã combo"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('price')
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
                                <div class="mt-3">
                                    <label for="status" class="block mb-4 text-sm font-medium text-gray-900 ">Combo nổi
                                        bật</label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="status" class="sr-only peer" value="1"
                                            {{ old('status') ? 'checked' : '' }}>
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900">Combo nổi bật</span>
                                    </label>
                                    @error('status')
                                        <p class="mt-2 text-sm text-red-600 ">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50">
                            <textarea id="wysiwygeditor" name="description">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div>
                        <div class="m-3 p-3 card">
                            <h2 class="pb-2">Pizza</h2>
                            <div class="flex flex-wrap justify-between gap-3 py-3">
                                <div class="flex-1">
                                    <select name="" id="" class="input">
                                        <option value="">Chọn pizza</option>
                                        @foreach ($pizzas as $pizza)
                                            <option value="{{ $pizza->id }}">{{ $pizza->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <select name="" id="" class="input">
                                        <option value="">Chọn đế</option>
                                        @foreach ($bases as $base)
                                            <option value="{{ $base->id }}">{{ $base->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <select name="" id="" class="input">
                                        <option value="">Chọn size</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <select name="" id="" class="input">
                                        <option value="">Chọn sốt</option>
                                        @foreach ($sauces as $sauce)
                                            <option value="{{ $sauce->id }}">{{ $sauce->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex rounded-md" role="group">
                                    <button
                                        class="rounded-s-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500"
                                        id="decrement" type="button">
                                        @svg('tabler-minus', 'icon-sm')
                                    </button>
                                    <input
                                        class="w-12 border-b border-t border-gray-200 bg-white px-4 py-1 text-center text-sm font-medium text-gray-900 focus:outline-none"
                                        name="quantity" value="1">
                                    <button
                                        class="rounded-e-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500"
                                        id="increment" type="button">
                                        @svg('tabler-plus', 'icon-sm')
                                    </button>
                                </div>
                                <div class="flex gap-3">
                                    <button type="button" class="flex button-blue add-field">
                                        Thêm
                                    </button>
                                    <button type="button" class="flex button-red remove-field">
                                        Xóa
                                    </button>
                                </div>
                            </div>
                            <div class="w-full">
                                <input type="checkbox" id="accordion-toggle" class="hidden peer">
                                <label for="accordion-toggle"
                                    class="w-full flex gap-3 cursor-pointer items-center px-5 text-slate-800">
                                    Toppings
                                    <svg class="w-5 h-5 transition-transform transform peer-checked:rotate-180"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </label>
                                <div class="overflow-hidden transition-all duration-300 max-h-0 peer-checked:max-h-96">
                                    <div class="flex flex-wrap justify-between gap-2 p-4">
                                        @foreach ($toppings as $topping)
                                            <div class="flex items-center me-4 gap-2">
                                                <input type="checkbox" name="{{ $topping->name }}"
                                                    id="{{ $topping->name }}" class="input-checkbox">
                                                <label for="{{ $topping->name }}"
                                                    class="">{{ $topping->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="category-container">
                            @foreach ($categories as $category)
                                <div class="p-3 m-3 card category-item" data-category-id="{{ $category->id }}">
                                    <h2 class="pb-2">{{ $category->name }}</h2>
                                    <div class="flex flex-wrap justify-between gap-10">
                                        <div class="flex-1">
                                            <select name="products[{{ $category->id }}]" class="input flex-1">
                                                <option value="">Chọn {{ $category->name }}</option>
                                                @foreach ($category->products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex rounded-md" role="group">
                                            <button
                                                class="rounded-s-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500 decrement"
                                                type="button">
                                                @svg('tabler-minus', 'icon-sm')
                                            </button>
                                            <input
                                                class="w-12 border-b border-t border-gray-200 bg-white px-4 py-1 text-center text-sm font-medium text-gray-900 focus:outline-none quantity-input"
                                                name="quantity_{{ $category->id }}" value="1">
                                            <button
                                                class="rounded-e-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500 increment"
                                                type="button">
                                                @svg('tabler-plus', 'icon-sm')
                                            </button>
                                        </div>
                                        <div class="flex gap-3">
                                            <button type="button" class="button-blue add-field"
                                                data-category-id="{{ $category->id }}">
                                                Thêm
                                            </button>
                                            <button type="button" class="button-red remove-field">
                                                Xóa
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-5">
                    <a href="{{ route('admin.combos.index') }}" class="button-dark">
                        Quay lại
                    </a>
                    <button type="submit" class="button-blue">
                        Thêm combo
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryContainer = document.getElementById('category-container');
            const categoryOptionsCache = {};

            function setupQuantityButtons(buttons) {
                buttons.forEach(button => {
                    button.addEventListener('click', function() {
                        const quantityInput = this.parentElement.querySelector('.quantity-input');
                        let currentValue = parseInt(quantityInput.value) || 0;
                        quantityInput.value = this.classList.contains('increment') ? currentValue +
                            1 : Math.max(currentValue - 1, 1);
                    });
                });
            }

            function setupCategoryButtons() {
                categoryContainer.addEventListener('click', function(event) {
                    const categoryItem = event.target.closest('.category-item');
                    if (!categoryItem) return;

                    const categoryId = event.target.dataset.categoryId;

                    if (event.target.classList.contains('add-field')) {
                        const categoryName = categoryItem.querySelector('h2').textContent;
                        const newField = createNewField(categoryId, categoryName, categoryItem);
                        categoryItem.appendChild(newField);
                        setupQuantityButtons(newField.querySelectorAll('.increment, .decrement'));
                    }
                    if (event.target.classList.contains('remove-field')) {
                        event.target.closest('.new-item')?.remove();
                    }
                });
            }

            function createNewField(categoryId, categoryName, categoryItem) {
                if (!categoryOptionsCache[categoryId]) {
                    categoryOptionsCache[categoryId] = Array.from(categoryItem.querySelectorAll('select option'))
                        .map(option => `<option value="${option.value}">${option.text}</option>`)
                        .join('');
                }

                const options = categoryOptionsCache[categoryId];

                const newField = document.createElement('div');
                newField.className = 'flex flex-wrap justify-between gap-10 new-item py-1';
                newField.innerHTML = `
                    <div class="flex-1">
                        <select name="products[${categoryId}]" class="input flex-1">
                            <option value="">Chọn ${categoryName}</option>
                            ${options}
                        </select>
                    </div>
                    <div class="flex rounded-md" role="group">
                        <button class="rounded-s-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500 decrement" type="button">
                            @svg('tabler-minus', 'icon-sm')
                        </button>
                        <input class="w-12 border-b border-t border-gray-200 bg-white px-4 py-1 text-center text-sm font-medium text-gray-900 focus:outline-none quantity-input" name="quantity_${categoryId}" value="1">
                        <button class="rounded-e-lg border border-gray-200 bg-white px-2 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-500 increment" type="button">
                            @svg('tabler-plus', 'icon-sm')
                        </button>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" class="button-blue add-field" data-category-id="${categoryId}">
                            Thêm
                        </button>
                        <button type="button" class="button-red remove-field">
                            Xóa
                        </button>
                    </div>`;

                return newField;
            }

            setupQuantityButtons(document.querySelectorAll('.increment, .decrement'));
            setupCategoryButtons();
        });
    </script>

@endsection
