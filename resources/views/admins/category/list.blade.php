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
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- item --}}
                    @forelse ($category as $key => $item)
                        <tr class="border-b">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                {{ ($category->currentPage() - 1) * $category->perPage() + $key + 1 }}
                            </th>
                            <td class="px-4 py-3">{{ $item->name }}</td>
                            <td class="px-4 py-3">{{ $item->slug }}</td>

                            <td class="px-4 py-3">
                               
                                <div class="flex items-center">
                                    <div
                                        class="inline-block indicator {{ $item->status == 1 ? 'bg-green-700' : 'bg-red-700' }}">
                                    </div>
                                    {{ $item->status == 1 ? 'Hoạt động' : 'Khóa' }}
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
                                        <a href="#" data-modal-target="delete-modal-{{ $item->id }}"
                                            data-modal-toggle="delete-modal-{{ $item->id }}"
                                            class="cursor-pointer block py-2 px-4 text-sm text-red-500 hover:bg-gray-100">Xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{-- start modal --}}
                        <div id="delete-modal-{{ $item->id }}" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="delete-modal-{{ $item->id }}">
                                        @svg('tabler-x', 'w-4 h-4')
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <div class="flex justify-center">
                                            @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                        </div>
                                        <h3 class="mb-5 font-normal">Bạn có muốn xóa Danh mục này không?</h3>

                                        <form action="{{ route('admin.categories.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button  type="submit"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"> Xóa
                                            </button>
                                        </form>

                                        <button data-modal-hide="delete-modal-{{ $item->id }}" type="button"
                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No,
                                            cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal --}}
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-base">
                                <div class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
                                    @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                    <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p> 
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    {{-- end item --}}



                </tbody>
            </table>
            <div class="p-4">
                {{ $category->links() }}
            </div>
        </div>
    </div>
@endsection
