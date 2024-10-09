@extends('layouts.admin')
@section('content')
    <div class="p-4 mx-auto">
        <h3 class="mb-4 text-lg font-bold text-gray-900 ">Banner</h3>
        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid gap-4 gap-x-5 mb-4 sm:grid-cols-2">
                {{-- url --}}
                <div>

                    <label for="url" class="block mb-2 text-base font-medium text-gray-900 ">Url</label>
                    <input type="text" name="url" id="name" value="{{ $banner->url }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">

                    @error('url')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Lỗi! </span>
                            {{ $message }}</p>
                    @enderror
                </div>
                {{-- end url --}}

                {{-- local page --}}
                <div class="">
                    <label for="url" class="block mb-3 text-base font-medium text-gray-900 ">Đường dẫn trang</label>
                    <div class="flex gap-x-3">

                        <div class="">
                            <input id="" type="radio" name="is_local_page"
                                class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300  rounded-full transition"
                                value="1" {{ $banner->is_local_page == 1 ? 'checked' : '' }}>
                            <label for="" class="ml-2 text-base cursor-pointer">
                                Trang cục bộ
                            </label>
                        </div>
                        <div class="">
                            <input id="" type="radio" name="is_local_page"
                                class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300  rounded-full transition"
                                value="2" {{ $banner->is_local_page == 2 ? 'checked' : '' }}>
                            <label for="" class="ml-2 text-base cursor-pointer">
                                Trang bên ngoài
                            </label>
                        </div>
                    </div>
                    @error('is_local_page')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Lỗi! </span>
                            {{ $message }}</p>
                    @enderror
                </div>
                {{-- end local page --}}


                {{-- image --}}
                <div class="mb-3">
                    <label for="image" class="block mb-2 text-base font-medium text-gray-900">Ảnh banner</label>
                    <input
                        class="mb-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        type="file" name="image" id="imageInput" accept="image/*">
                   
                    <div class="h-auto overflow-hidden relative rounded-md shadow-lg">
                        <a id="imageLink" href="{{ asset('storage/uploads/banners/' . $banner->image) }}" target="_blank"
                            class="block">
                            <img loading="lazy" id="currentImage" src="{{ asset('storage/uploads/banners/' . $banner->image) }}"
                                class="w-full h-full object-cover rounded-md transform transition-all duration-500"
                                alt="Banner image">
                            <div
                                class="absolute bottom-2 right-2 bg-white px-2 py-1 text-xs font-semibold text-gray-800 rounded-md shadow-md">
                                Nhấp vào để xem ảnh lớn
                            </div>
                    </div>
                </div>
                {{-- end image --}}

                {{-- status --}}
                <div class="">
                    <label for="name" class="block mb-3 mt-1 text-base font-medium text-gray-900 ">Trạng thái</label>
                    <div class="flex items-center">
                        <label for="status-toggle" class="inline-flex relative items-center cursor-pointer">
                            <input type="checkbox" id="status-toggle" name="status" class="sr-only peer" value="1"
                                {{ $banner->status == 1 ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>

                        </label>
                    </div>

                </div>
                {{-- end status --}}


            </div>
            <div class="flex items-center space-x-4 mt-7">
                <button type="submit" class=" rounded-lg button-blue">
                    Cập Nhật    
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
