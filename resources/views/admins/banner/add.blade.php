@extends('layouts.admin')
@section('content')
    <div class="p-4 mx-auto">
        <h3 class="mb-4 text-lg font-bold text-gray-900 ">Banner</h3>
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-2">

                <div>

                    <label for="name" class="block mb-2 text-base font-medium text-gray-900 ">Ảnh banner</label>
                    <input
                        class="mb-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none "
                        type="file" name="image" value="">

                    @error('image')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Lỗi! </span>
                            {{ $message }}</p>
                    @enderror
                </div>

                <div>

                    <label for="url" class="block mb-2 text-base font-medium text-gray-900 ">Url</label>
                    <input type="text" name="url" id="name" value="{{ old('url') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">

                    @error('url')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Lỗi! </span>
                            {{ $message }}</p>
                    @enderror
                </div>

                <div class="">
                    <label for="url" class="block mb-2 text-base font-medium text-gray-900 ">Local Page</label>
                    <div class="flex gap-x-3">

                        <div class=" mb-4">
                            <input id="" type="radio" name="is_local_page"
                                class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300  rounded-full transition"
                                value="1">
                            <label for="" class="ml-2 text-base cursor-pointer">
                                Local Page
                            </label>
                        </div>
                        <div class="">
                            <input id="" type="radio" name="is_local_page"
                                class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300  rounded-full transition" value="">
                            <label for="" class="ml-2 text-base cursor-pointer">
                                External Page
                            </label>
                        </div>
                    </div>
                    @error('is_local_page')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Lỗi! </span>
                            {{ $message }}</p>
                    @enderror
                </div>



                <div class="">
                    <label for="name" class="block mb-2 text-base font-medium text-gray-900 ">Trạng thái</label>
                    <div class="flex items-center">
                        <label for="status-toggle" class="inline-flex relative items-center cursor-pointer">
                            <input type="checkbox" id="status-toggle" name="status" class="sr-only peer" value="1">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>

                        </label>
                    </div>

                </div>
            </div>
            <div class="flex items-center space-x-4 mt-7">
                <button type="submit" class=" rounded-lg button-blue">
                    Lưu
                </button>
                <a href="">
                    <button type="button" class="rounded-lg button-green">Quay Lại</button>
                </a>
            </div>
        </form>
    </div>
@endsection
