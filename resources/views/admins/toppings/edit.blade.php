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
                <div class="w-full h-10 mb-5">
                    <label for="name" class="label-lg">Tên</label>
                    <input type="text" name="name" class="input mb-2" value="{{ $editTopping->name }}" />
                    @error('name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="w-full h-10 mb-5">
                    <label class="label-lg">Ảnh</label>
                    <div>
                        <input
                            class="mb-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none "
                            type="file" name="image">
                        <a class="shrink-0" data-fslightbox="gallery"
                            href="{{ asset('storage/uploads/toppings/' . $editTopping->image) }}">
                            <img loading="lazy" src="{{ asset('storage/uploads/toppings/' . $editTopping->image) }}"
                                class="img-sm mt-2 img-circle object-cover">
                        </a>
                    </div>
                    
                    @error('image')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex justify-between gap-2 mt-20 mb-20">
                <div class="w-full h-10 mb-5">
                    <label for="price" class="label-lg">Giá</label>
                    <input type="number" name="price" class="input mb-2" value="{{ $editTopping->price }}" />
                    @error('price')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full h-10 mb-5">
                    <label for="category_id" class="label-lg">Danh mục</label>
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
            <div
                class="mb-4 flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <button class="button-blue">Cập Nhật</button>
                <a href="{{ route('admin.toppings.index') }}"
                    class="flex items-center justify-center px-4 py-2 text-sm text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-0">Quay
                    lại</a>
            </div>
        </form>
    </div>
@endsection
