@extends('layouts.admin')
@section('title', 'Topping | Thêm mới')

@section('content')
    {{ Breadcrumbs::render('admin.toppings.create') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Thêm mới topping</h3>
            <form action="{{ route('admin.toppings.store') }}" class="w-full" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="label-md">Tên topping <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" class="input" value="{{ old('name') }}"
                            placeholder="VD: Xúc xích" />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="quantity" class="label-md">Số lượng <span class="text-red-500">*</span></label>
                        <input type="number" name="quantity" id="quantity" class="input" value="{{ old('quantity') }}"
                            placeholder="VD: 13" />
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="price" class="label-md">Giá <span class="text-red-500">*</span></label>
                        <input type="number" name="price" id="price" class="input" value="{{ old('price') }}"
                            placeholder="VD: 18000" />
                        @error('price')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="category_id" class="label-md ">Danh mục <span class="text-red-500">*</span></label>
                        <select class="select" name="category_id" id="category_id">
                            <option value="">Chọn</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="image" class="label-md">Ảnh topping <span class="text-red-500">*</span></label>
                    <div class="sm:col-span-2">
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
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div
                    class="mb-4 flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                    <button class="button-blue" type="submit">Thêm thuộc tính</button>
                    <a href="{{ route('admin.toppings.index') }}" class="button-gray">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
