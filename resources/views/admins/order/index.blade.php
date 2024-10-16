@extends('layouts.admin')
@section('title', 'Danh sách đơn hàng')

@section('content')
    {{ Breadcrumbs::render('admin.orders.index') }}

    <div class="mt-5 bg-white shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h2 class="font-medium text-gray-700 text-base">
                    Đơn hàng
                </h2>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <button type="button"
                    class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0">
                    @svg('tabler-file-export', 'w-4 h-4 mr-2')
                    Xuất dữ liệu
                </button>
            </div>
        </div>
        <div class="p-4 border-b bg-gray-50">
            <!-- Các tab điều hướng -->
            <ul class="flex space-x-4">
                {{-- Tất cả --}}
                <li>
                    <a href="{{ route('admin.orders.index') }}"
                        class="px-4 py-2 border-b-2 {{ request('status') ? 'border-transparent text-gray-500' : 'border-red-600 font-semibold text-red-600' }}">
                        Tất cả
                    </a>
                </li>
                {{-- Hoàn thành --}}
                <li>
                    <a href="{{ route('admin.orders.index', ['status' => 'Hoàn thành']) }}"
                        class="px-4 py-2 border-b-2 {{ request('status') === 'Hoàn thành' ? 'border-red-600 font-semibold text-red-600' : 'border-transparent text-gray-500' }}">
                        Hoàn thành
                    </a>
                </li>
                {{-- Đã xác nhận --}}
                <li>
                    <a href="{{ route('admin.orders.index', ['status' => 'Đã xác nhận']) }}"
                        class="px-4 py-2 border-b-2 {{ request('status') === 'Đã xác nhận' ? 'border-red-600 font-semibold text-red-600' : 'border-transparent text-gray-500' }}">
                        Đã xác nhận
                    </a>
                </li>
                {{-- Chờ xác nhận --}}
                <li>
                    <a href="{{ route('admin.orders.index', ['status' => 'Chờ xác nhận']) }}"
                        class="px-4 py-2 border-b-2 {{ request('status') === 'Chờ xác nhận' ? 'border-red-600 font-semibold text-red-600' : 'border-transparent text-gray-500' }}">
                        Chờ xác nhận
                    </a>
                </li>
                {{-- Đang giao hàng  --}}
                <li>
                    <a href="{{ route('admin.orders.index', ['status' => 'Đang giao hàng']) }}"
                        class="px-4 py-2 border-b-2 {{ request('status') === 'Đang giao hàng' ? 'border-red-600 font-semibold text-red-600' : 'border-transparent text-gray-500' }}">
                        Đang giao hàng
                    </a>
                </li>
                {{-- Đang tìm tài xế --}}
                <li>
                    <a href="{{ route('admin.orders.index', ['status' => 'Đang tìm tài xế']) }}"
                        class="px-4 py-2 border-b-2 {{ request('status') === 'Đang tìm tài xế' ? 'border-red-600 font-semibold text-red-600' : 'border-transparent text-gray-500' }}">
                        Đang tìm tài xế
                    </a>
                </li>
                {{-- Đã hủy --}}
                <li>
                    <a href="{{ route('admin.orders.index', ['status' => 'Đã hủy']) }}"
                        class="px-4 py-2 border-b-2 {{ request('status') === 'Đã hủy' ? 'border-red-600 font-semibold text-red-600' : 'border-transparent text-gray-500' }}">
                        Đã hủy
                    </a>
                </li>
            </ul>
        </div>
        {{--  --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="bg-gray-50 text-gray-700 uppercase">
                    <tr>
                        <th class="px-4 py-3">STT</th>
                        <th class="px-4 py-3">Tên người dùng</th>
                        <th class="px-4 py-3">Địa chỉ</th>
                        <th class="px-4 py-3">Tổng số tiền</th>
                        <th class="px-4 py-3">Trạng thái</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">
                                {{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $order->user->fullname }}</td>
                            <td class="px-4 py-2">
                                <p>{{ $order->address->detail_address }}</p>
                                <p>{{ $order->address->ward }}, {{ $order->address->district }},
                                    {{ $order->address->province }}</p>
                            </td>
                            <td class="px-4 py-2">{{ number_format($order->amount) }}đ</td>
                            <td class="px-4 py-2">
                                <button
                                    class="px-4 py-2 text-white rounded-xl w-36
                                {{ $order->orderStatus->name === 'Chờ xác nhận'? 'bg-yellow-500': 
                                ($order->orderStatus->name === 'Đã xác nhận'? 'bg-blue-500': 
                                ($order->orderStatus->name === 'Đang tìm tài xế'? 'bg-gray-500': 
                                ($order->orderStatus->name === 'Đang giao hàng'? 'bg-gray-500' : 
                                ($order->orderStatus->name === 'Hoàn thành'? 'bg-green-600':
                                ($order->orderStatus->name === 'Đã hủy' ? 'bg-slate-600': 'bg-gray-500'))))) }}">
                                    {{ $order->orderStatus->name }}
                                </button>
                            </td>
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
                                            <a href="#" class="block py-2 px-4 hover:bg-gray-100"
                                                data-modal-target="order-modal-{{ $order->id }}"
                                                data-modal-toggle="order-modal-{{ $order->id }}">Chi tiết </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        {{-- order modal --}}
                        <div id="order-modal-{{ $order->id }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-5xl h-auto">
                                <div
                                    class="relative p-4 bg-white rounded-lg shadow sm:p-5 h-[480px] overflow-y-auto no-scrollbar">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="order-modal-{{ $order->id }}">
                                        @svg('tabler-x', 'w-4 h-4')
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5">
                                        <div class="space-y-4">
                                            <div class="flex justify-between">
                                                <h1 class="text-2xl font-semibold">Đơn hàng</h1>
                                                <div class="flex justify-center gap-2">
                                                    @if ($order->orderStatus->name === 'Hoàn thành')
                                                        <a href="">
                                                            <button class="mt-4 button-red w-36">Xem hóa đơn</button>
                                                        </a>                                                 
                                                    @endif
                                                    @php
                                                        // Xác định màu sắc dựa trên trạng thái đơn hàng
                                                        $buttonClass = match ($order->orderStatus->name) {
                                                            'Hoàn thành' => 'button-green',
                                                            'Đang giao hàng' => 'button-gray',
                                                            'Đang tìm tài xế' => 'button-gray',
                                                            'Chờ xác nhận' => 'button-yellow',
                                                            'Đã xác nhận' => 'button-blue',
                                                            'Đã hủy' => 'button-red',
                                                            default => 'button-gray', // Trạng thái mặc định
                                                        };
                                                    @endphp

                                                    <button class="mt-4 {{ $buttonClass }} w-36">
                                                        {{ $order->orderStatus->name }}
                                                    </button>

                                                </div>
                                            </div>
                                            <hr class="w-full">
                                            {{-- user_id --}}
                                            <div class="pl-4 rounded-lg ">
                                                <label class="font-semibold">Thông tin thanh toán</label>
                                                <p class="text-gray-800 mt-4">{{ $order->user->fullname }}</p>
                                                <p class="text-gray-800">{{ $order->address->detail_address }}</p>
                                                <p class="text-gray-800">{{ $order->address->ward }}</p>
                                                <p class="text-gray-800">{{ $order->address->district }}</p>
                                            </div>
                                            {{-- Email --}}
                                            <div class="pl-4 rounded-lg">
                                                <label class="font-semibold">Email</label>
                                                <p class="text-gray-800">{{ $order->user->email }}</p>
                                            </div>
                                            {{-- SĐT --}}
                                            <div class="pl-4 rounded-lg">
                                                <label class="font-semibold">Số điện thoại</label>
                                                <p class="text-gray-800">{{ $order->user->phone }}</p>
                                            </div>
                                            {{-- hình thức thanh toán --}}
                                            <div class="pl-4 rounded-lg ">
                                                <label class="font-semibold">Hình thức thanh toán</label>
                                                <p class="text-gray-800">{{ $order->paymentMethod->name }}</p>
                                            </div>
                                            <hr class="w-full">
                                            {{-- <div class="pl-4 rounded-lg">
                                                <div>
                                                    <h2>Sản phẩm</h2>
                                                    <p>{{$order->product->name}}</p>
                                                </div>
                                            </div> --}}
                                            <div class="flex justify-end">
                                                <a href="{{ route('admin.orders.edit', $order->id) }}">
                                                    <button class="button-blue">Sửa</button>
                                                </a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end order modal --}}
                        {{--  --}}
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
                {{ $orders->onEachSide(1)->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
