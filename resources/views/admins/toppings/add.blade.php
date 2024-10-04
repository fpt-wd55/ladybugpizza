@extends('layouts.admin')
@section('title', 'Thêm mới Topping')

@section('content')
    <div class="container">
        <form action="{{ route('admin.toppings.store') }}" class="w-full" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex justify-between gap-2">
                <div class="w-full mb-5">
                    <label for="name" class="label-lg">Tên</label>
                    <input type="text" name="name" class="input h-10" value="{{ old('name') }}" />
                    @error('name')
                        <span class="text-red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full mb-5">
                    <label for="image" class="label-lg">Ảnh</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none " type="file" name="image">
                    @error('image')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex justify-between gap-2 mt-4">
                <div class="w-full mb-5">
                    <label for="price" class="label-lg">Giá</label>
                    <input type="text" name="price" class="input h-10" value="{{ old('price') }}" />
                    @error('price')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full mb-5">
                    <label for="category_id" class="label-lg ">Danh mục</label>
                    <select class="w-full h-10 select" name="category_id" id="">
                        <option value="">Chọn</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }} {{ old('category_id') }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div
                class="mb-4 flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <button
                    class="flex items-center justify-center px-4 py-2 text-sm text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-0">Thêm</button>
                <a href="{{ route('admin.toppings.index') }}"
                    class="flex items-center justify-center px-4 py-2 text-sm text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-0">Quay
                    lại</a>
            </div>
        </form>
    </div>
@endsection
