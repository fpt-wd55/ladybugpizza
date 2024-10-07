@extends('layouts.admin')
@section('title', 'Thuộc tính | Thêm thuộc tính')
@section('content')
    {{ Breadcrumbs::render('admin.users.create') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Thêm thuộc tính</h3>
            <form action="{{ route('admin.attributes.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-1">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Tên thuộc tính</label>
                        <input type="text" name="email" id="email" placeholder="Tên thuộc tính"
                            value="{{ old('email') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('email')
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
                                    <th class="px-4 py-2">
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
                                            <td class="border px-4 py-2" colspan="2">
                                                <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                                                    <div>
                                                        <input type="text"
                                                            name="stocks[{{ $key }}][attribute_value]"
                                                            id="fullname" placeholder="Tên giá trị"
                                                            value="{{ $stock['attribute_value'] ?? '' }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                        @error("stocks.{$key}.attribute_value")
                                                            <p class="mt-2 text-sm text-red-600 ">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <input type="number"
                                                            name="stocks[{{ $key }}][attribute_quatity]"
                                                            id="fullname" placeholder="Số lượng"
                                                            value="{{ $stock['attribute_quatity'] ?? '' }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                        @error("stocks.{$key}.attribute_quatity")
                                                            <p class="mt-2 text-sm text-red-600 ">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border px-4 py-2 text-center">
                                                <button class="btn-add-more-rm">
                                                    @svg('tabler-trash-x-filled', 'w-7 h-7 mr-2 text-red-500')
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="border px-4 py-2" colspan="2">
                                            <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                                                <div>
                                                    <input type="text" name="stocks[0][attribute_value]"
                                                        placeholder="Tên giá trị"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                </div>
                                                <div>
                                                    <input type="number" name="stocks[0][attribute_quatity]"
                                                        placeholder="Số lượng"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <button class="btn-add-more-rm">
                                                @svg('tabler-trash-x-filled', 'w-6 h-6 mr-2 text-red-500')
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-5">
                    <a href="{{ route('admin.users.index') }}" class="button-dark">
                        Quay lại
                    </a>
                    <button type="submit" class="button-blue">
                        Thêm thuộc tính
                    </button>
                </div>
            </form>
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
                        <td class="border px-4 py-2" colspan="2">
                            <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                                <div>
                                    <input type="text" name="stocks[${i}][attribute_value]" placeholder="Tên giá trị" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                </div>
                                <div>
                                    <input type="number" name="stocks[${i}][attribute_quatity]" placeholder="Số lượng" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                </div>
                            </div>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button class="btn-add-more-rm">
                                @svg('tabler-trash-x-filled', 'w-6 h-6 mr-2 text-red-500')
                            </button>
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
