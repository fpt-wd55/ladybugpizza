@extends('layouts.admin')
@section('title', 'Thuộc tính - Thùng rác')
@section('content')
    {{ Breadcrumbs::render('admin.trash-attributes') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h2 class="font-medium text-gray-700 text-base">
                    Thùng rác
                </h2>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <a href="{{ route('admin.attributes.index') }}" class="button-gray">
                    @svg('tabler-arrow-back-up', 'w-5 h-5 mr-2')
                    Quay lại
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
                                <button data-modal-target="restore-modal-{{ $attribute->id }}"
                                    data-modal-toggle="restore-modal-{{ $attribute->id }}"
                                    class="inline-flex items-center p-0.5 text-sm text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none">
                                    @svg('tabler-restore', 'w-5 h-5 mx-1 text-green-500')
                                </button>
                                <button data-modal-target="destroy-modal-{{ $attribute->id }}"
                                    data-modal-toggle="destroy-modal-{{ $attribute->id }}"
                                    class="inline-flex items-center p-0.5 text-sm text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none">
                                    @svg('tabler-trash-x', 'w-5 h-5 mx-1 text-red-500')
                                </button>
                            </td>
                            {{-- Modal khoi phuc xóa --}}
                            <div id="restore-modal-{{ $attribute->id }}" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                            data-modal-hide="restore-modal-{{ $attribute->id }}">
                                            @svg('tabler-x', 'w-4 h-4')
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <div class="flex justify-center">
                                                @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                            </div>
                                            <h3 class="mb-5 font-normal">Bạn có muốn Khôi phục thuộc tính này không?</h3>

                                            <div class="flex justify-center items-center">
                                                <form action="{{ route('admin.restore-attribute', $attribute->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit"
                                                        class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-0 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Khôi phục
                                                    </button>
                                                </form>

                                                <button data-modal-hide="restore-modal-{{ $attribute->id }}" type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-0">
                                                    Không
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Modal xoa vinh vien --}}
                            <div id="destroy-modal-{{ $attribute->id }}" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                            data-modal-hide="destroy-modal-{{ $attribute->id }}">
                                            @svg('tabler-x', 'w-4 h-4')
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <div class="flex justify-center">
                                                @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                            </div>
                                            <h3 class="mb-5 font-normal">Bạn có muốn xóa vĩnh viễn Thuộc tính này không?
                                            </h3>

                                            <div class="flex justify-center items-center">
                                                <form action="{{ route('admin.delete-attribute', $attribute->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-0 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Xóa vĩnh viễn
                                                    </button>
                                                </form>

                                                <button data-modal-hide="destroy-modal-{{ $attribute->id }}" type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-0">
                                                    Không
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                {{ $attributes->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
