@extends('layouts.admin')
@section('title', 'Banner | Chỉnh sửa')
@section('content')
    {{ Breadcrumbs::render('admin.banners.edit', $banner) }}
    <div class="mx-auto p-4">
        <h3 class="mb-4 text-lg font-bold text-gray-900">Banner</h3>
        <form action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4 grid gap-4 gap-x-5 sm:grid-cols-2">
                {{-- url --}}
                <div>
                    <label class="mb-2 block text-base font-medium text-gray-900" for="url">Url</label>
                    <input
                        class="focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900"
                        id="name" name="url" type="text" value="{{ $banner->url }}">
                    @error('url')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Lỗi! </span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                {{-- end url --}}
                {{-- local page --}}
                <div class="">
                    <label class="mb-3 block text-base font-medium text-gray-900" for="url">Đường dẫn trang</label>
                    <div class="flex gap-x-3">

                        <div class="">
                            <input {{ $banner->is_local_page == 1 ? 'checked' : '' }} class="input-radio" id="local"
                                name="is_local_page" type="radio" value="1">
                            <label class="ml-2 cursor-pointer text-base" for="local">
                                Trang cục bộ
                            </label>
                        </div>
                        <div class="">
                            <input {{ $banner->is_local_page == 2 ? 'checked' : '' }} class="input-radio" id="external"
                                name="is_local_page" type="radio" value="2">
                            <label class="ml-2 cursor-pointer text-base" for="external">
                                Trang bên ngoài
                            </label>
                        </div>
                    </div>
                    @error('is_local_page')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Lỗi! </span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                {{-- end local page --}}
                {{-- image --}}
                <div class="mb-3">
                    <label class="mb-2 block text-base font-medium text-gray-900" for="image">Ảnh banner</label>
                    <input accept="image/*"
                        class="mb-4 block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none"
                        id="imageInput" name="image" type="file">

                    <div class="relative h-auto overflow-hidden rounded-md shadow-lg">
                        <a class="block" href="{{ asset('storage/uploads/banners/' . $banner->image) }}" id="imageLink"
                            target="_blank">
                            <img alt="Banner image"
                                class="h-full w-full transform rounded-md object-cover transition-all duration-500"
                                id="currentImage" loading="lazy"
                                src="{{ asset('storage/uploads/banners/' . $banner->image) }}">
                            <div
                                class="absolute bottom-2 right-2 rounded-md bg-white px-2 py-1 text-xs font-semibold text-gray-800 shadow-md">
                                Nhấp vào để xem ảnh lớn
                            </div>
                    </div>
                </div>
                {{-- end image --}}

                {{-- status --}}
                <div class="">
                    <label class="mb-3 mt-1 block text-base font-medium text-gray-900" for="name">Trạng thái</label>
                    <div class="flex items-center">
                        <label class="relative inline-flex cursor-pointer items-center" for="status-toggle">
                            <input {{ $banner->status == 1 ? 'checked' : '' }} class="peer sr-only" id="status-toggle"
                                name="status" type="checkbox" value="1">
                            <div
                                class="peer h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-red-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none dark:border-gray-600 dark:bg-gray-700">
                            </div>

                        </label>
                    </div>

                </div>
                {{-- end status --}}


            </div>
            <div class="mt-7 flex items-center space-x-4">
                <button class="button-red" type="submit">
                    Cập Nhật
                </button>
                <a href="{{ route('admin.banners.index') }}">
                    <button class="button-gray" type="button">Quay Lại</button>
                </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();


            reader.onload = function(e) {
                document.getElementById('currentImage').src = e.target.result;

                const blobUrl = URL.createObjectURL(file);
                document.getElementById('imageLink').href = blobUrl;
            }

            // Đọc file dưới dạng URL
            reader.readAsDataURL(file);
        });
    </script>
@endsection
