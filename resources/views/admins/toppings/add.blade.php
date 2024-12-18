@extends('layouts.admin')
@section('title', 'Topping | Thêm mới')

@section('content')
    {{ Breadcrumbs::render('admin.toppings.create') }}
    <div class="relative mt-5 overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="mx-auto p-4">
            <h3 class="mb-4 text-lg font-bold text-gray-900">Thêm mới topping</h3>
            <form action="{{ route('admin.toppings.store') }}" class="w-full" enctype="multipart/form-data" method="post">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="row-span-2">
                        <label class="label-md" for="image">Ảnh topping <span class="text-red-500">*</span></label>
                        <div class="">
                            <div class="flex w-full items-center justify-center">
                                <label class="flex h-20 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100" for="dropzone-file">
                                    <div class="flex flex-col items-center justify-center pb-6 pt-5">
                                        @svg('tabler-cloud-upload', 'w-8 h-8 text-gray-400 mb-2')
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Nhấn để tải lên</span>
                                            hoặc kéo thả
                                            vào đây
                                        </p>
                                    </div>
                                    <input class="hidden" id="dropzone-file" name="image" type="file" />
                                </label>
                            </div>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label class="label-md" for="name">Tên topping <span class="text-red-500">*</span></label>
                        <input class="input" id="name" name="name" placeholder="VD: Xúc xích" type="text" value="{{ old('name') }}" />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="label-md" for="quantity">Số lượng <span class="text-red-500">*</span></label>
                        <input class="input" id="quantity" name="quantity" placeholder="VD: 13" type="number" value="{{ old('quantity') }}" />
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="label-md" for="price">Giá <span class="text-red-500">*</span></label>
                        <input class="input" id="price" name="price" placeholder="VD: 18000" type="number" value="{{ old('price') }}" />
                        @error('price')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="label-md" for="category_id">Danh mục <span class="text-red-500">*</span></label>
                        <select class="select" id="category_id" name="category_id">
                            <option value="">Chọn</option>
                            @foreach ($categories as $category)
                                <option {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
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
                <div class="mb-4 flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                    <button class="button-blue" type="submit">Thêm thuộc tính</button>
                    <a class="button-gray" href="{{ route('admin.toppings.index') }}">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
