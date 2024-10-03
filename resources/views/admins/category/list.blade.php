@extends('layouts.admin')
@section('content')
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">


        <div
            class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3 p-4">
            <a href="{{ route('admin.categories.create') }}"
                class="flex items-center justify-center px-4 py-2 text-sm text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-0">
                @svg('tabler-plus', 'w-5 h-5 mr-2')
                Thêm danh mục
            </a>
            <a href="{{ route('admin.trash.listcate') }}"
                class="flex items-center justify-center px-4 py-2 text-sm text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-0">
                @svg('tabler-trash', 'w-5 h-5 mr-2')
                Thùng rác
            </a>
            <a href=""
                class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0">
                @svg('tabler-rotate-clockwise', 'w-4 h-4 mr-2')
                Làm mới
            </a>

        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">STT</th>
                        <th scope="col" class="px-4 py-3">Tên danh mục</th>
                        <th scope="col" class="px-4 py-3">Slug</th>
                      
                        <th scope="col" class="px-4 py-3">Trạng thái</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($category as $key => $item)
                        <tr class="border-b">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                {{ ($category->currentPage() - 1) * $category->perPage() + $key + 1 }}
                            </th>
                            <td class="px-4 py-3">{{ $item->name }}</td>
                            <td class="px-4 py-3">{{ $item->slug }}</td>
                           
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <label for="{{ $item->name }}"
                                        class="inline-flex relative items-center cursor-pointer">
                                        <input type="checkbox" id="{{ $item->name }}" class="sr-only peer"
                                            {{ $item->status == 1 ? 'checked' : '' }} disabled>
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                        </div>

                                    </label>
                                </div>
                            </td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="{{ $item->name }}-dropdown-button"
                                    data-dropdown-toggle="{{ $item->name }}-dropdown"
                                    class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                    type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div id="{{ $item->name }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700"
                                        aria-labelledby="{{ $item->name }}-dropdown-button">

                                        <li>
                                            <a href="{{ route('admin.categories.edit', $item) }}"
                                                class="block py-2 px-4 hover:bg-gray-100">Edit</a>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <form action="{{ route('admin.categories.destroy', $item) }}" method="POST"
                                            onsubmit="return confirm('Bạn muốn xóa không ?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="block w-full text-left py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-base">( Dữ liệu trống )</td>
                        </tr>
                    @endforelse



                </tbody>
            </table>
            <div class="p-4">
                {{ $category->links() }}
            </div>
        </div>
    </div>
@endsection
