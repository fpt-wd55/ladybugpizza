@extends('layouts.admin')
@section('title', 'Thuộc tính')
@section('content')
    {{-- {{ Breadcrumbs::render('admin.users.index') }} --}}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h2 class="font-medium text-gray-700 text-base">
                    Thuộc tính
                </h2>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <a href="{{ route('admin.attributes.create') }}" class="button-blue">
                    @svg('tabler-plus', 'w-5 h-5 mr-2')
                    Thêm thuộc tính
                </a>
                <a href="{{route('admin.trash-attributes')}}" class="button-red">
                    @svg('tabler-trash', 'w-5 h-5 mr-2')
                    Thùng rác
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3 hidden md:block">STT</th>
                        <th scope="col" class="px-4 py-3">Thuộc tính</th>
                        <th scope="col" class="px-4 py-3">Số lượng</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attributes as $attribute)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap font-medium hidden md:block">
                                {{ ($attributes->currentpage() - 1) * $attributes->perpage() + $loop->index + 1 }}
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap font-medium">
                                <span class="flex items-center">
                                    {{ $attribute->name }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap"></td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="{{ $attribute->id }}" data-dropdown-toggle="{{ $attribute->id }}-dropdown"
                                    class="inline-flex items-center p-0.5 text-sm text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                    type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div id="{{ $attribute->id }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="{{ $attribute->id }}">
                                        <li>
                                            <a href="{{ route('admin.attributes.edit', $attribute) }}"
                                                class="block py-2 px-4 hover:bg-gray-100">Cập nhật</a>
                                        </li>
                                    </ul>
                                    <ul class="py-1 text-sm text-gray-700">
                                        <li>
                                            <span data-modal-target="delete-modal-{{ $attribute->id }}"
                                                data-modal-toggle="delete-modal-{{ $attribute->id }}"
                                                class="cursor-pointer block py-2 px-4 text-sm text-red-500 hover:bg-gray-100">Xóa</span>
                                        </li>
                                    </ul>
                                </div>
                                {{-- Modal xác nhận xóa --}}
                                <div id="delete-modal-{{ $attribute->id }}" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                data-modal-hide="delete-modal-{{ $attribute->id }}">
                                                @svg('tabler-x', 'w-4 h-4')
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <div class="flex justify-center">
                                                    @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                                </div>
                                                <h3 class="mb-5 font-normal">Bạn có muốn xóa Thuộc tính này không?</h3>

                                                <div class="flex justify-center items-center">
                                                    <form action="{{route('admin.attributes.destroy', $attribute)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-0 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Xóa
                                                        </button>
                                                    </form>

                                                    <button data-modal-hide="delete-modal-{{ $attribute->id }}"
                                                        type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-0">
                                                        Không
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{-- Giá trị thuộc tính --}}
                        @foreach ($attribute->values as $value)
                            <tr class="border-b">
                                <td class="px-4 py-2 text-gray-900 whitespace-nowrap hidden md:block"></td>
                                <td class="px-4 py-2 text-gray-900 whitespace-nowrap">--- <span
                                        class="ms-1">{{ $value->value }}</span>
                                </td>
                                <td class="px-4 py-2 text-gray-900 whitespace-nowrap">{{ $value->quantity ?? '0' }}
                                </td>
                                <td class="px-4 py-2 text-gray-900 whitespace-nowrap"></td>
                            </tr>
                        @endforeach
                    @empty
                        <!-- Hiển thị "Trống" nếu không có dữ liệu -->
                        <td colspan="6" class="text-center py-4 text-base">
                            <div class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
                                @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4">
                {{ $attributes->links() }}
            </div>
        </div>
    </div>
@endsection
