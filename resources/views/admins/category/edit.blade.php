@extends('layouts.admin')
@section('content')
  
    <div class="p-4 mx-auto">
        <h3 class="mb-4 text-lg font-bold text-gray-900 ">Category</h3>
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-2">

                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
                    <input type="text" name="name" id="name" value="iPad Air Gen 5th Wi-Fi"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Ex. Apple iMac 27&ldquo;">
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Lỗi!</span> Username
                        already
                        taken!</p>
                </div>
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Slug</label>
                    <input type="text" name="slug" id="slug" value="iPad Air Gen 5th Wi-Fi"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Ex. Apple iMac 27&ldquo;">
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Lỗi!</span> Username
                        already
                        taken!</p>
                </div>


                <div class="sm:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                        file</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" name="image" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
                        SVG, PNG, JPG or GIF.
                    </p>
                </div>




                <div class="flex items-center">
                    <div class="mr-5">
                        <input id="default-radio-1" type="radio" value="2" name="status"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-1"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">active
                        </label>
                    </div>
                    <div class="mr-5">
                        <input id="default-radio-1" type="radio" value="1" name="status"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-1"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">inactive</label>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
