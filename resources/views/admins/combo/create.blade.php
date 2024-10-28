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
                        <table id="example" class="table-auto w-full rounded-md table-add-more">
                            <thead>
                                <tr class="border">
                                    <th colspan="2" class="px-4 py-2 text-start text-base font-medium">Thêm sản phẩm</th>
                                    <th class="px-6 py-2 text-end">
                                        <a href="#" class="font-medium text-blue-600 hover:underline btn-add-more">+
                                            Thêm mới</a>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="border px-4 py-2" colspan="3">
                                        <h2 class="pb-2">Pizza</h2>
                                        <div class="grid grid-cols-1 gap-3 md:grid-cols-8">
                                            <div class="md:col-span-2">
                                                <select name="" id="" class="input">
                                                    <option value="">Chọn pizza</option>
                                                </select>
                                            </div>
                                            <div class="md:col-span-2">
                                                <select name="" id="" class="input">
                                                    <option value="">Chọn thuộc tính</option>
                                                </select>
                                            </div>
                                            <div class="md:col-span-2">
                                                <input type="number" name="" placeholder="Số lượng"
                                                    class="input" min="0">
                                            </div>
                                            <div class="flex gap-3 md:col-span-2">
                                                <button type="button" class="flex items-center button-blue">
                                                    Thêm sản phẩm
                                                </button>
                                                <button type="button" class="flex items-center button-red">
                                                    Xóa sản phẩm
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2" colspan="3">
                                        <h2 class="pb-2">Bánh</h2>
                                        <div class="grid grid-cols-1 gap-3 md:grid-cols-8">
                                            <div class="md:col-span-2">
                                                <select name="" id="" class="input">
                                                    <option value="">Chọn pizza</option>
                                                </select>
                                            </div>
                                            <div class="md:col-span-2">
                                                <select name="" id="" class="input">
                                                    <option value="">Chọn thuộc tính</option>
                                                </select>
                                            </div>
                                            <div class="md:col-span-2">
                                                <input type="number" name="" placeholder="Số lượng"
                                                    class="input" min="0">
                                            </div>
                                            <div class="flex gap-3 md:col-span-2">
                                                <button type="button" class="flex items-center button-blue">
                                                    Thêm sản phẩm
                                                </button>
                                                <button type="button" class="flex items-center button-red">
                                                    Xóa sản phẩm
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
@endsection
