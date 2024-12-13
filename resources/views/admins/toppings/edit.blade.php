@extends('layouts.admin')
@section('title', 'Topping | Cập nhật')

@section('content')
    {{ Breadcrumbs::render('admin.toppings.edit', $editTopping) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Cập nhật topping</h3>
            <form action="{{ route('admin.toppings.update', $editTopping) }}" class="w-full" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="">
                        <label for="name" class="label-md">Tên topping <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" class="input" placeholder="VD: Xúc xích"
                            value="{{ $editTopping->name }}" />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="">
                        <label for="quantity" class="label-md">Số lượng <span class="text-red-500">*</span></label>
                        <input type="number" name="quantity" id="quantity" class="input" placeholder="VD: 13"
                            value="{{ $editTopping->quantity }}" />
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="">
                        <label for="price" class="label-md">Giá <span class="text-red-500">*</span></label>
                        <input type="number" name="price" id="price" class="input" placeholder="VD: 18000"
                            value="{{ $editTopping->price }}" />
                        @error('price')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="">
                        <label for="category_id" class="label-md">Danh mục <span class="text-red-500">*</span></label>
                        <select class="select" name="category_id" id="category_id">
                            <option value="">Chọn </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $editTopping->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <label for="name" class="label-md">Ảnh topping <span class="text-red-500">*</span></label>
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
                    <p class="mt-2 text-sm text-red-600 ">
                        {{ $message }}
                    </p>
                @enderror
                <div
                    class="mb-4 flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                    <button class="button-blue">Cập nhật topping</button>
                    <a href="{{ route('admin.toppings.index') }}" class="button-gray">Quay
                        lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
