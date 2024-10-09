@extends('layouts.admin')
@section('title', 'Thuộc tính | Cập nhật thuộc tính')
@section('content')
    {{ Breadcrumbs::render('admin.attributes.edit', $attribute) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Cập nhật thuộc tính</h3>
            <form action="{{ route('admin.attributes.update', $attribute) }}" method="post">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 sm:grid-cols-1">
                    <div>
                        <label for="attribute_name" class="block mb-2 text-sm font-medium text-gray-900 ">Tên thuộc
                            tính</label>
                        <input type="text" name="attribute_name" id="attribute_name" placeholder="Tên thuộc tính"
                            value="{{ old('attribute_name', $attribute->name) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('attribute_name')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <table id="example" class="table-auto w-full rounded-md table-add-more">
                            <thead>
                                <tr class="border">
                                    <th colspan="2" class="px-4 py-2 text-start text-base font-medium">Thêm giá trị</th>
                                    <th class="px-6 py-2 text-end">
                                        <a href="#" class="font-medium text-blue-600 hover:underline btn-add-more">+
                                            Thêm mới</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $key = 0;
                                @endphp
                                @if (request()->old('stocks'))
                                    @foreach (request()->old('stocks') as $key => $stock)
                                        <tr>
                                            <td class="border px-4 py-2" colspan="3">
                                                <div class="grid grid-cols-1 gap-3 md:grid-cols-6">
                                                    <div class="md:col-span-3">
                                                        <input type="text"
                                                            name="stocks[{{ $key }}][attribute_value]"
                                                            placeholder="Tên giá trị"
                                                            value="{{ $stock['attribute_value'] ?? '' }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                        @error("stocks.{$key}.attribute_value")
                                                            <p class="mt-2 text-sm text-red-600 ">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="md:col-span-2">
                                                        <input type="number"
                                                            name="stocks[{{ $key }}][attribute_quantity]"
                                                            placeholder="Số lượng"
                                                            value="{{ $stock['attribute_quantity'] ?? '' }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                        @error("stocks.{$key}.attribute_quantity")
                                                            <p class="mt-2 text-sm text-red-600 ">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="md:col-span-1">
                                                        <button type="button"
                                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 btn-add-more-rm w-full">
                                                            Xóa giá trị
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-5">
                    <a href="{{ route('admin.attributes.index') }}" class="button-dark">
                        Quay lại
                    </a>
                    <button type="submit" class="button-blue">
                        Cập nhật thuộc tính
                    </button>
                </div>
            </form>
            <h3 class="mt-10 mb-4 text-lg font-bold text-gray-900 ">Danh sách giá trị</h3>
            <div class="overflow-x-auto">
                <table class="table-auto w-full rounded-md table-add-more">
                    <thead>
                        <tr class="border">
                            <th colspan="2" class="px-4 py-2 text-start text-base font-medium">Danh sách giá trị</th>
                            <th class="px-6 py-2 text-end"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2" colspan="3">
                                <div class="grid grid-cols-1 gap-3 md:grid-cols-6">
                                    <div class="md:col-span-3">
                                        <input type="text" name="stocks[0][attribute_value]" placeholder="Tên giá trị"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                    </div>
                                    <div class="md:col-span-2">
                                        <input type="number" name="stocks[0][attribute_quantity]" placeholder="Số lượng"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                    </div>
                                    <div class="md:col-span-1">
                                        <button type="button"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 btn-add-more-rm w-full">
                                            Xóa giá trị
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3">Thuộc tính</th>
                            <th scope="col" class="px-4 py-3">Số lượng</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Hành động</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody data-accordion="open">
                        @forelse ($attribute->values as $value)
                            <tr class="border-b">
                                <td class="px-4 py-2 text-gray-900 whitespace-nowrap"><span
                                        class="ms-1">{{ $value->value }}</span>
                                </td>
                                <td class="px-4 py-2 text-gray-900 whitespace-nowrap">{{ $value->quantity ?? '0' }}
                                </td>
                                <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                    <span data-modal-target="delete-modal-{{ $value->id }}"
                                        data-modal-toggle="delete-modal-{{ $value->id }}">
                                        @svg('tabler-trash-x-filled', 'w-5 h-5 text-red-600')
                                    </span>
                                </td>
                            </tr>
                            {{-- delete value attribute modal --}}
                            <div id="delete-modal-{{ $value->id }}" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                            data-modal-hide="delete-modal-{{ $value->id }}">
                                            @svg('tabler-x', 'w-4 h-4')
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <div class="flex justify-center">
                                                @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                            </div>
                                            <h3 class="mb-5 font-normal">Bạn có muốn xóa giá trị này không?</h3>

                                            <form action="{{ route('admin.attributes.remove-value', $value) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-0 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Xóa
                                                </button>
                                            </form>

                                            <button data-modal-hide="delete-modal-{{ $value->id }}" type="button"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-0">Không</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <!-- Hiển thị "Trống" nếu không có dữ liệu -->
                            <td colspan="6" class="text-center py-4 text-base">
                                <div
                                    class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
                                    @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                    <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                                </div>
                            </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let i = parseInt(document.querySelector('meta[name="key"]')?.getAttribute('content') || 0, 10);

            document.querySelector('.btn-add-more').addEventListener('click', function(e) {
                e.preventDefault();
                i++;
                document.querySelector('.table-add-more tbody').insertAdjacentHTML('beforeend', `
                    <tr>
                        <td class="border px-4 py-2" colspan="3">
                            <div class="grid grid-cols-1 gap-3 md:grid-cols-6">
                                <div class="md:col-span-3">
                                    <input type="text" name="stocks[${i}][attribute_value]"
                                        placeholder="Tên giá trị"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                </div>
                                <div class="md:col-span-2">
                                    <input type="number" name="stocks[${i}][attribute_quantity]"
                                        placeholder="Số lượng"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                </div>
                                <div class="md:col-span-1">
                                    <button type="button"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 btn-add-more-rm w-full">
                                        Xóa giá trị
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                `);
            });

            document.addEventListener('click', function(e) {
                if (e.target.closest('.btn-add-more-rm')) {
                    e.target.closest('tr').remove();
                }
            });
        });
    </script>
@endsection
