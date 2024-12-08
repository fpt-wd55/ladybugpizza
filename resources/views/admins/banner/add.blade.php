@extends('layouts.admin')
@section('title', 'Banner | Thêm mới')
@section('content')
    {{ Breadcrumbs::render('admin.banners.create') }}
    <div class="p-4 mx-auto">
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <label for="url" class="block mb-2 text-base font-medium text-gray-900 ">Url</label>
                    <input type="text" name="url" id="name" value="{{ old('url') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:border-primary-600 block w-full p-2.5">

                    @error('url')
                        <p class="mt-2 text-sm text-red-600  "><span class="font-medium">Lỗi! </span>
                            {{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="url" class="block mb-3 text-base font-medium text-gray-900 ">Đường dẫn trang</label>
                    <div class="flex gap-x-3">

                        <div class=" mb-4">
                            <input id="" type="radio" name="is_local_page"
                                class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300  rounded-full transition"
                                value="1">
                            <label for="" class="ml-2 text-base cursor-pointer">
                                Trang cục bộ
                            </label>
                        </div>
                        <div>
                            <input id="" type="radio" name="is_local_page"
                                class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300  rounded-full transition"
                                value="2">
                            <label for="" class="ml-2 text-base cursor-pointer">
                                Trang ngoài
                            </label>
                        </div>
                    </div>
                    @error('is_local_page')
                        <p class="mt-2 text-sm text-red-600  "><span class="font-medium">Lỗi! </span>
                            {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="name" class="block mb-2 text-base font-medium text-gray-900">Ảnh banner</label>
                    <input
                        class="mb-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        type="file" name="image" value="" id="imageInput" accept="image/*"
                        onchange="previewImage(event)">
                    @error('image')
                        <p class="mt-2 text-sm text-red-600  "><span class="font-medium">Lỗi! </span>
                            {{ $message }}</p>
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
                <div>
                    <label for="name" class="block mb-3 mt-1 text-base font-medium text-gray-900 ">Trạng thái</label>
                    <div class="flex items-center">
                        <label for="status-toggle" class="inline-flex relative items-center cursor-pointer">
                            <input type="checkbox" id="status-toggle" name="status" class="sr-only peer" value="1">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none  rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                            </div>

                        </label>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-4 mt-7">
                <button type="submit" class=" rounded-lg button-blue">
                    Lưu
                </button>
                <a href="{{ route('admin.banners.index') }}">
                    <button type="button" class="rounded-lg button-green">Quay Lại</button>
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
