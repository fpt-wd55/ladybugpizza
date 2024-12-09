@extends('layouts.admin')
@section('title', 'Topping | Thêm mới')

@section('content')
    {{ Breadcrumbs::render('admin.toppings.create') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Thêm mới topping</h3>
            <form action="{{ route('admin.toppings.store') }}" class="w-full" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-between gap-2">
                    <div class="w-full mb-5">
                        <label for="name" class="label-lg">Tên topping <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" class="input mb-2" value="{{ old('name') }}"
                            placeholder="VD: Xúc xích" />
                        @error('name')
                            <span style="color: red ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-5">
                        <label for="quantity" class="label-lg">Số lượng <span class="text-red-500">*</span></label>
                        <input type="number" name="quantity" id="quantity" class="input mb-2"
                            value="{{ old('quantity') }}" placeholder="VD: 13" />
                        @error('quantity')
                            <span style="color: red ">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-between gap-2 mt-4">
                    <div class="w-full mb-5">
                        <label for="price" class="label-lg">Giá <span class="text-red-500">*</span></label>
                        <input type="number" name="price" id="price" class="input mb-2" value="{{ old('price') }}"
                            placeholder="VD: 18000" />
                        @error('price')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-5">
                        <label for="category_id" class="label-lg ">Danh mục <span class="text-red-500">*</span></label>
                        <select class="w-full h-10 mb-2 select" name="category_id" id="category_id">
                            <option value="">Chọn</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="w-full mb-5">
                    <label for="image" class="label-lg">Ảnh topping <span class="text-red-500">*</span></label>
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
