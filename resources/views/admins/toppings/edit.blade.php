@extends('layouts.admin')
@section('title', 'Topping | Chỉnh sửa')

@section('content')
    {{ Breadcrumbs::render('admin.toppings.edit', $editTopping) }}
    <div>
        <form action="{{ route('admin.toppings.update', $editTopping) }}" class="w-full" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex justify-between gap-2">
                <div class="w-full mb-5">
                    <label for="name" class="label-lg">Tên thuộc tính <span class="text-red-500">*</span></label>
                    <input type="text" name="name" class="input mb-2" value="{{ $editTopping->name }}" />
                    @error('name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full mb-5">
                    <label for="name" class="label-lg">Số lượng <span class="text-red-500">*</span></label>
                    <input type="number" name="quantity" class="input mb-2" value="{{ $editTopping->quantity }}" />
                    @error('quantity')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex justify-between gap-2 mt-4">
                <div class="w-full mb-5">
                    <label for="price" class="label-lg">Giá <span class="text-red-500">*</span></label>
                    <input type="number" name="price" class="input mb-2" value="{{ $editTopping->price }}" />
                    @error('price')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full mb-5">
                    <label for="category_id" class="label-lg">Danh mục <span class="text-red-500">*</span></label>
                    <select class="select w-full mb-2" name="category_id">
                        <option value="">Chọn </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $editTopping->category_id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <label for="name" class="label-lg">Ảnh thuộc tính <span class="text-red-500">*</span></label>
            <div class="flex gap-3">
                <a class="shrink-0" data-fslightbox="gallery"
                    href="{{ asset('storage/uploads/toppings/' . $editTopping->image) }}">
                    <img loading="lazy" class="w-20 h-20 rounded-md object-cover"
                        src="{{ asset('storage/uploads/toppings/' . $editTopping->image) }}">
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
                <span style="color: red">{{ $message }}</span>
            @enderror
            <div
                class="mb-4 flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <button class="button-blue">Cập Nhật</button>
                <a href="{{ route('admin.toppings.index') }}" class="button-gray">Quay
                    lại</a>
            </div>
        </form>
    </div>
@endsection
