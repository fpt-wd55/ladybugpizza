@extends('layouts.admin')
@section('title', 'Danh sách đơn hàng')

@section('content')
    {{ Breadcrumbs::render('admin.orders.index') }}
    <div class="mt-5 bg-white shadow sm:rounded-lg">
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h2 class="font-medium text-gray-700 text-base">
                    Đơn hàng
                </h2>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <button data-modal-target="filterDropdown" data-modal-toggle="filterDropdown"
                    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                    type="button">
                    @svg('tabler-filter-filled', 'w-5 h-5 me-2')
                    Bộ lọc
                </button>
                <a href="{{ route('admin.orders.export') }}"
                    class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0">
                    @svg('tabler-file-export', 'w-4 h-4 mr-2')
                    Xuất dữ liệu
                </a>
                <form action="{{ route('admin.orders.filter') }}" method="get" id="filterDropdown" tabindex="-1"
                    aria-hidden="true"
                    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full">
                    <div class="relative w-full h-full max-w-2xl md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between px-6 py-4 rounded-t">
                                <h3 class="text-lg font-semibold text-gray-500 dark:text-gray-400">
                                    Bộ lọc
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-toggle="filterDropdown">
                                    @svg('tabler-x', 'w-5 h-5')
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="px-4 md:px-6">
                                <h6 class="my-3 text-sm font-medium text-gray-900">Trạng thái</h6>
                                <ul class="space-y-2 text-sm">
                                    <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                        @foreach ($orderStatuses as $status)
                                            <li class="flex items-center">
                                                <input type="checkbox" name="filter_status[]" value="{{ $status->id }}"
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                                    @if (in_array($status->id, request()->input('filter_status', []))) checked @endif>
                                                <label for="active"
                                                    class="ml-2 text-sm font-medium text-gray-900">{{ $status->name }}</label>
                                            </li>
                                        @endforeach
                                    </div>
                                </ul>
                                <h6 class="my-3 text-sm font-medium text-gray-900">Phương thức thanh toán</h6>
                                <ul class="space-y-2 text-sm">
                                    <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                        @foreach ($paymentMethods as $paymentMethod)
                                            <li class="flex items-center">
                                                <input type="checkbox" name="filter_paymentMethod[]"
                                                    value="{{ $paymentMethod->id }}"
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0"
                                                    @if (in_array($paymentMethod->id, request()->input('filter_paymentMethod', []))) checked @endif>
                                                <label for="active"
                                                    class="ml-2 text-sm font-medium text-gray-900">{{ $paymentMethod->name }}</label>
                                            </li>
                                        @endforeach
                                    </div>
                                </ul>
                                <h6 class="my-3 text-sm font-medium text-gray-900">Tổng đơn hàng</h6>
                                <div class="flex items-center">
                                    <div>
                                        <input name="filter_amount_min" type="number"
                                            value="{{ request()->input('filter_amount_min') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                            placeholder="1.000 đ">
                                    </div>
                                    <span class="mx-4 text-gray-500">-</span>
                                    <div>
                                        <input name="filter_amount_max" type="number"
                                            value="{{ request()->input('filter_amount_max') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                            placeholder="100.000.000 đ">
                                    </div>
                                </div>
                                <h6 class="my-3 text-sm font-medium text-gray-900">Ngày đặt hàng</h6>
                                <div class="flex items-center">
                                    <div>
                                        <input name="filter_date_min" type="date"
                                            value="{{ request()->input('filter_date_min') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                            placeholder="mm/dd/yyyy">
                                    </div>
                                    <span class="mx-4 text-gray-500">-</span>
                                    <div>
                                        <input name="filter_date_max" type="date"
                                            value="{{ request()->input('filter_date_max') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                            placeholder="mm/dd/yyyy">
                                    </div>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-4 rounded-b">
                                <button type="submit" class="button-red">
                                    Lọc dữ liệu
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="p-4 border-b bg-gray-50">
            <!-- Các tab điều hướng -->
            <ul class="flex">
                <li class="me-6 min-w-fit relative mx-4">
                    <a aria-current="page"
                        class="inline-block rounded-t-lg pb-1 border-b-2 {{ request()->routeIs('admin.orders.index') && request('tab') === null ? 'border-[#D30A0A] text-[#D30A0A]' : 'border-transparent' }}"
                        href="{{ route('admin.orders.index') }}">
                        Tất cả
                        @if ($totalOrders > 0)
                            <span class="text-white bg-[#D30A0A] text-xs font-medium ms-1 px-1 rounded-full">
                                {{ $totalOrders }}
                            </span>
                        @endif
                    </a>
                </li>
                @foreach ($orderStatuses as $status)
                    <li class="me-6 min-w-fit relative mx-4">
                        <a aria-current="page"
                            class="inline-block rounded-t-lg border-b-2 pb-1 {{ request()->get('tab') === $status->slug ? 'border-[#D30A0A] text-[#D30A0A]' : 'border-transparent' }}"
                            href="{{ route('admin.orders.index', ['tab' => $status->slug]) }}">
                            {{ $status->name }}
                            @if ($status->orders_count > 0)
                                <span class="text-white bg-[#D30A0A] text-xs font-medium ms-1 px-1 rounded-full">
                                    {{ $status->orders_count }}
                                </span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="bg-gray-50 text-gray-700 uppercase">
                    <tr>
                        <th class="px-4 py-3">Tên người dùng</th>
                        <th class="px-4 py-3">Địa chỉ</th>
                        <th class="px-4 py-3">Tổng số tiền</th>
                        <th class="px-4 py-3">Trạng thái</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only uppercase">Hành động </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $order->user->fullname }}</td>
                            <td class="px-4 py-2">
                                <p>{{ $order->address->detail_address }}</p>
                                <p>{{ $order->ward->name_with_type }}, {{ $order->district->name_with_type }},
                                    {{ $order->province->name_with_type }}</p>
                            </td>
                            <td class="px-4 py-2">
                                {{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}đ</td>
                            <td class="px-4 py-2">
                                @php
                                    $colorClasses = [
                                        'yellow' => 'bg-yellow-500',
                                        'blue' => 'bg-blue-500',
                                        'gray' => 'bg-gray-500',
                                        'green' => 'bg-green-600',
                                        'red' => 'bg-red-600',
                                    ];

                                    $colorClass = $colorClasses[$order->orderStatus->color] ?? 'bg-gray-500';
                                @endphp
                                <span
                                    class="me-2 mt-1.5 inline-flex shrink-0 items-center rounded px-2.5 py-0.5 text-xs font-medium text-white  {{ $colorClass }}">
                                    {{ $order->orderStatus->name }}
                                </span>
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
                                        <li>
                                            <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                class="block py-2 px-4 hover:bg-gray-100">Cập nhật
                                            </a>
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
                                    class="relative p-5 md:p-8 bg-white rounded-lg shadow h-[480px] overflow-y-auto no-scrollbar">
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-center">
                                            <h1 class="text-xl font-semibold">Đơn hàng #{{ $order->id }}</h1>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                data-modal-hide="order-modal-{{ $order->id }}">
                                                @svg('tabler-x', 'w-4 h-4')
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="flex justify-start items-center">
                                            @if ($order->orderStatus->name === 'Hoàn thành')
                                                @if ($order->invoice)
                                                    <a
                                                        href="{{ route('invoices.show', $order->invoice->invoice_number) }}">
                                                        <button class="button-red">Xem hóa đơn</button>
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                        <hr class="w-full">
                                        <div class="pl-4 rounded-lg">
                                            <label class="font-semibold">Trạng thái đơn hàng</label>
                                            <p
                                                class="mx-2 mt-1.5 inline-block shrink-0 items-center rounded px-2.5 py-0.5 text-xs font-medium text-white  {{ $colorClass }}">
                                                {{ $order->orderStatus->name }}
                                            </p>
                                        </div>
                                        {{-- user_id --}}
                                        <div class="pl-4 rounded-lg ">
                                            <label class="font-semibold">Thông tin thanh toán</label>
                                            <p class="text-gray-800 mt-4">{{ $order->user->fullname }}</p>
                                            <p class="text-gray-800">{{ $order->address->detail_address }}</p>
                                            <p class="text-gray-800">{{ $order->ward->name_with_type }},
                                                {{ $order->district->name_with_type }},
                                                {{ $order->province->name_with_type }}</p>
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
                                        @if ($order->orderStatus->name === 'Đã hủy')
                                            <div class="pl-4 rounded-lg ">
                                                <label class="font-semibold">Lí do hủy đơn</label>
                                                <p class="text-gray-800">{{ $order->canceled_reason }}</p>
                                            </div>
                                        @endif
                                        <hr class="w-full">
                                        {{-- SẢN PHẨM --}}
                                        <div class="flex justify-between">
                                            <div class="basic-2/3">
                                                <div class="pl-4">
                                                    <label class="font-semibold mb-5 text-base">Sản phẩm</label> <br>
                                                    @foreach ($order->orderItems as $orderItem)
                                                        <div
                                                            class="flex items-center whitespace-nowrap py-2 text-gray-900">
                                                            <a class="shrink-0" data-fslightbox="gallery"
                                                                href="{{ asset('storage/uploads/products/' . $orderItem->product->image) }}">
                                                                <img class="mr-3 h-8 w-8 rounded object-cover"
                                                                    loading="lazy"
                                                                    onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'"
                                                                    src="{{ asset('storage/uploads/products/' . $orderItem->product->image) }}">
                                                            </a>
                                                            <div>
                                                                <div class="grid grid-flow-row">
                                                                    <span
                                                                        class="text-sm">{{ $orderItem->product->name }}</span>
                                                                    <span class="text-sm text-gray-500">
                                                                        @if ($orderItem->atrributeValues->count() > 0)
                                                                            {{ $orderItem->atrributeValues->map->value->join(', ') }}
                                                                        @endif
                                                                        @if ($orderItem->toppingValues->count() > 0)
                                                                            <span>- Topping:
                                                                            </span>{{ $orderItem->toppingValues->map->name->join(', ') }}
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end order modal --}}
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
