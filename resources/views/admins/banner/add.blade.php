@extends('layouts.admin')
@section('title', 'Banner | Thêm mới')
@section('content')
    {{ Breadcrumbs::render('admin.banners.create') }}
    <div class="p-4 mx-auto">
        <h3 class="mb-4 text-lg font-bold text-gray-900 ">Thêm mới banner</h3>
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <label for="url" class="label-md">Url <span class="text-red-500">*</span></label>
                    <input type="text" name="url" id="name" value="{{ old('url') }}"
                        placeholder="VD: ladybugpizza.vn/banner/" class="input">
                    @error('url')
                        <p class="mt-2 text-sm text-red-600 ">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label class="label-md">Đường dẫn trang <span class="text-red-500">*</span></label>
                    <div class="flex gap-3">
                        <div class="mt-1">
                            <input id="is_local_page" type="radio" name="is_local_page" class="input-radio"
                                value="1">
                            <label for="is_local_page" class="ml-2 text-base cursor-pointer">
                                Trang cục bộ
                            </label>
                        </div>
                        <div class="mt-1">
                            <input id="external_page" type="radio" name="is_local_page" class="input-radio"
                                value="2">
                            <label for="external_page" class="ml-2 text-base cursor-pointer">
                                Trang ngoài
                            </label>
                        </div>
                    </div>
                    @error('is_local_page')
                        <p class="mt-2 text-sm text-red-600  ">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="status" class="label-md">Trạng
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
                </div>
            </div>
            <div>
                <label for="name" class="label-md">Ảnh banner <span class="text-red-500">*</span></label>
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
                @error('image')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
                <div class="mt-2">
                    <div id="imagePreview" class="h-auto overflow-hidden relative rounded-md shadow-lg"
                        style="display: none;">
                        <img loading="lazy" id="currentImage"
                            class="w-full h-full object-cover rounded-md transform transition-all duration-500"
                            alt="Banner image">
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-4 mt-7">
                <button type="submit" class="button-blue">
                    Thêm banner
                </button>
                <a href="{{ route('admin.banners.index') }}">
                    <button type="button" class="button-gray">Quay Lại</button>
                </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function previewImage(event) {
            var imageInput = document.getElementById('imageInput');
            var imagePreview = document.getElementById('imagePreview');
            var currentImage = document.getElementById('currentImage');

            if (imageInput.files && imageInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    currentImage.src = e.target.result;
                    imagePreview.style.display = 'block';
                }

                reader.readAsDataURL(imageInput.files[0]);
            } else {
                imagePreview.style.display = 'none';
            }
        }
    </script>
@endsection
