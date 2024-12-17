@extends('layouts.admin')
@section('title', 'Banner | Cập nhật')
@section('content')
    {{ Breadcrumbs::render('admin.banners.edit', $banner) }}
    <div class="mx-auto p-4">
        <h3 class="mb-4 text-lg font-bold text-gray-900">Cập nhật banner</h3>
        <form action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4 grid gap-4 sm:grid-cols-3">
                <div>
                    <label class="label-md" for="url">Url <span class="text-red-500">*</span></label>
                    <input class="input" id="url" name="url" placeholder="VD: ladybugpizza.vn/banner/" type="text" value="{{ $banner->url }}">
                    @error('url')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label class="label-md" for="url">Đường dẫn trang <span class="text-red-500">*</span></label>
                    <div class="flex gap-3">
                        <div class="mt-1">
                            <input {{ $banner->is_local_page == 1 ? 'checked' : '' }} class="input-radio" id="local" name="is_local_page" type="radio" value="1">
                            <label class="ml-2 cursor-pointer text-base" for="local">
                                Trang cục bộ
                            </label>
                        </div>
                        <div class="mt-1">
                            <input {{ $banner->is_local_page == 2 ? 'checked' : '' }} class="input-radio" id="external" name="is_local_page" type="radio" value="2">
                            <label class="ml-2 cursor-pointer text-base" for="external">
                                Trang ngoài
                            </label>
                        </div>
                    </div>
                    @error('is_local_page')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label class="mb-4 block text-sm font-medium text-gray-900" for="status">Trạng
                        thái</label>
                    <label class="inline-flex cursor-pointer items-center">
                        <input {{ old('status', $banner->status) == 1 ? 'checked' : '' }} class="peer sr-only" name="status" type="checkbox" value="1">
                        <div class="peer relative h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-0 rtl:peer-checked:after:-translate-x-full">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900">Hoạt
                            động</span>
                    </label>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="label-md" for="image">Ảnh banner <span class="text-red-500">*</span></label>
                <input accept="image/*" class="mb-4 block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none" id="imageInput" name="image" type="file">

                <div class="relative h-auto overflow-hidden rounded-md shadow-lg">
                    <img class="h-full w-full transform rounded-md object-cover transition-all duration-500" data-fslightbox="gallery" id="currentImage" loading="lazy" src="{{ asset('storage/uploads/banners/' . $banner->image) }}">
                </div>
            </div>
            <div class="mt-7 flex items-center space-x-4">
                <button class="button-blue" type="submit">
                    Cập nhật banner
                </button>
                <a href="{{ route('admin.banners.index') }}">
                    <button class="button-gray" type="button">Quay Lại</button>
                </a>
            </div>
        </form>
    </div>
@endsection
