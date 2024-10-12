@extends('layouts.admin')
@section('title', 'Danh sách mã giảm giá')

@section('content')
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto ">
            <div
                class="mr-4 my-4 flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                @if (session('message'))
                    <div class="button bg-green-400">
                        {{ session('message') }}
                    </div>
                @endif
                {{-- <a href="{{ route('admin.orders.create') }}" class="button-blue">
                    @svg('tabler-plus', 'w-5 h-5 mr-2')
                    Thêm mới mã giảm giá
                </a> --}}
            </div>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">STT</th>
                        <th scope="col" class="px-4 py-3">Tên người dùng</th>
                        <th scope="col" class="px-4 py-3">Mã giảm giá</th>
                        <th scope="col" class="px-4 py-3">Địa chỉ</th>
                        <th scope="col" class="px-4 py-3">Tổng số tiền</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-b hover:bg-gray-100">
                            <!-- Tính toán STT dựa trên trang hiện tại -->
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                {{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">{{ $order->user->fullname }}</td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                @isset($order->promotion->code)
                                    {{ $order->promotion->code }}
                                @else
                                    Không 
                                @endisset
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">{{ $order->address->detail_address   }}</td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">{{ $order->amount}}</td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="{{ $order->id }}" data-dropdown-toggle="{{ $order->id }}-dropdown"
                                    class="inline-flex items-center p-0.5 text-sm text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                    type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div id="{{ $order->id }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="{{ $order->id }}">
                                        <li>
                                            <a href="{{ route('admin.orders.show', $order) }}"
                                                class="block py-2 px-4 hover:bg-gray-100">Chi tiết</a>
                                        </li>
                                    </ul>                                  
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td colspan="6" class="text-center py-4 text-base">
                            <div class="flex flex-col items-center justify-center p-6 rounded-lg bg-white w-full h-80">
                                @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
