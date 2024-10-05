@extends('layouts.admin')
@section('title', 'Thùng rác')

@section('content')
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <div
                class="mr-4 my-4 flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                @if (session('message'))
                    <div class="button bg-green-400">
                        {{ session('message') }}
                    </div>
                @endif
                <div
                    class="mb-4 flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                    <a href="{{ route('admin.toppings.index') }}" class="button-green">Quay
                        lại</a>
                </div>
            </div>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">STT</th>
                        <th scope="col" class="px-4 py-3">Tên</th>
                        <th scope="col" class="px-4 py-3">Ảnh</th>
                        <th scope="col" class="px-4 py-3">Giá</th>
                        <th scope="col" class="px-4 py-3">Danh mục</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listTopping as $topping)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                {{ ($listTopping->currentPage() - 1) * $listTopping->perPage() + $loop->iteration }}</td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">{{ $topping->name }}</td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">
                                <img src="{{ asset('/storage/' . $topping->image) }}" class="img-sm img-circle object-cover"
                                    alt="">
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">{{ number_format($topping->price) }}đ</td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                @foreach ($categories as $category)
                                    @if ($category->id == $topping->category_id)
                                        <span>{{ $category->name }}</span>
                                    @endif
                                @endforeach
                            </td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="{{ $topping->name }}" data-dropdown-toggle="{{ $topping->name }}-dropdown"
                                    class="inline-flex items-center p-0.5 text-sm text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                    type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div id="{{ $topping->name }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="{{ $topping->name }}">
                                        <li>
                                            <a href="{{ route('admin.resTopping', $topping->id) }}"
                                                class="block py-2 px-4 hover:bg-gray-100">Khôi Phục</a>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <form action="{{ route('admin.forceDelete-Toppings', $topping->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn chứ?')"
                                                data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                                class="cursor-pointer block py-2 px-4 text-sm text-red-500 hover:bg-gray-100">Xóa</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td colspan="6" class="text-center py-4 text-base">
                            <div class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
                                @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                            </div>
                        </td>
                        <!-- Hiển thị "Trống" nếu không có dữ liệu -->
                    @endforelse
                </tbody>
            </table>
            <div class="p-4">
                {{ $listTopping->links() }}
            </div>
        </div>
    </div>
@endsection
