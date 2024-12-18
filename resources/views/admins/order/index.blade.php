@extends('layouts.admin')
@section('title', 'Đơn hàng')

@section('content')
    {{ Breadcrumbs::render('admin.orders.index') }}
    <div class="mt-5 bg-white shadow sm:rounded-lg">
        <div class="flex flex-col space-y-3 px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
            <div class="flex flex-1 items-center space-x-4">
                <h2 class="text-base font-medium text-gray-700">
                    Đơn hàng
                </h2>
            </div>
            <div class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                <div class="flex items-center justify-end gap-3">
                    <button class="button-light flex w-full items-center justify-center" data-modal-target="filterDropdown" data-modal-toggle="filterDropdown" type="button">
                        @svg('tabler-filter-filled', 'w-5 h-5 me-2')
                        Bộ lọc
                    </button>
                    <a class="button-light flex w-full items-center justify-center min-w-40" href="{{ route('admin.orders.export') }}">
                        @svg('tabler-file-export', 'w-5 h-5 me-2')
                        Xuất dữ liệu
                    </a>
                </div>
                <form action="{{ route('admin.orders.filter') }}" aria-hidden="true" class="fixed inset-0 z-50 hidden h-modal w-full overflow-y-auto overflow-x-hidden p-4 md:h-full" id="filterDropdown" method="get" tabindex="-1">
                    <div class="relative h-full w-full max-w-2xl md:h-auto">
                        <!-- Modal content -->
                        <div class="relative rounded-lg bg-white shadow">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between rounded-t px-6 py-4">
                                <h3 class="text-lg font-semibold text-gray-500">
                                    Bộ lọc
                                </h3>
                                <button class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-toggle="filterDropdown" type="button">
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
                                                <input @if (in_array($status->id, request()->input('filter_status', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" name="filter_status[]" type="checkbox" value="{{ $status->id }}">
                                                <label class="ml-2 text-sm font-medium text-gray-900" for="active">{{ $status->name }}</label>
                                            </li>
                                        @endforeach
                                    </div>
                                </ul>
                                <h6 class="my-3 text-sm font-medium text-gray-900">Phương thức thanh toán</h6>
                                <ul class="space-y-2 text-sm">
                                    <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                        @foreach ($paymentMethods as $paymentMethod)
                                            <li class="flex items-center">
                                                <input @if (in_array($paymentMethod->id, request()->input('filter_paymentMethod', []))) checked @endif class="text-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-0" name="filter_paymentMethod[]" type="checkbox" value="{{ $paymentMethod->id }}">
                                                <label class="ml-2 text-sm font-medium text-gray-900" for="active">{{ $paymentMethod->name }}</label>
                                            </li>
                                        @endforeach
                                    </div>
                                </ul>
                                <h6 class="my-3 text-sm font-medium text-gray-900">Tổng đơn hàng</h6>
                                <div class="flex items-center">
                                    <div>
                                        <input class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-3 text-sm text-gray-900 focus:ring-0" name="filter_amount_min" placeholder="1.000 đ" type="number" value="{{ request()->input('filter_amount_min') }}">
                                    </div>
                                    <span class="mx-4 text-gray-500">-</span>
                                    <div>
                                        <input class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-3 text-sm text-gray-900 focus:ring-0" name="filter_amount_max" placeholder="100.000.000 đ" type="number" value="{{ request()->input('filter_amount_max') }}">
                                    </div>
                                </div>
                                <h6 class="my-3 text-sm font-medium text-gray-900">Ngày đặt hàng</h6>
                                <div class="flex items-center">
                                    <div>
                                        <input class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-3 text-sm text-gray-900 focus:ring-0" name="filter_date_min" placeholder="mm/dd/yyyy" type="date" value="{{ request()->input('filter_date_min') }}">
                                    </div>
                                    <span class="mx-4 text-gray-500">-</span>
                                    <div>
                                        <input class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-3 text-sm text-gray-900 focus:ring-0" name="filter_date_max" placeholder="mm/dd/yyyy" type="date" value="{{ request()->input('filter_date_max') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="flex items-center space-x-4 rounded-b p-6">
                                <button class="button-red" type="submit">
                                    Lọc dữ liệu
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="no-scrollbar mb-4 overflow-x-auto border-gray-200 text-left">
            <!-- Các tab điều hướng -->
            <ul class="flex">
                <li class="relative mx-4 me-6 min-w-fit">
                    <a aria-current="page" class="{{ request()->routeIs('admin.orders.index') && request('tab') === null ? 'border-[#D30A0A] text-[#D30A0A]' : 'border-transparent' }} inline-block rounded-t-lg border-b-2 pb-1" href="{{ route('admin.orders.index') }}">
                        Tất cả
                        @if (isset($totalOrders) && $totalOrders > 0)
                            <span class="ms-1 rounded-full bg-[#D30A0A] px-1 text-xs font-medium text-white">
                                {{ $totalOrders }}
                            </span>
                        @endif
                    </a>
                </li>
                @foreach ($orderStatuses as $status)
                    <li class="relative mx-4 me-6 min-w-fit">
                        <a aria-current="page" class="{{ request()->get('tab') === $status->slug ? 'border-[#D30A0A] text-[#D30A0A]' : 'border-transparent' }} inline-block rounded-t-lg border-b-2 pb-1" href="{{ route('admin.orders.index', ['tab' => $status->slug]) }}">
                            {{ $status->name }}
                            @if ($status->orders_count > 0)
                                <span class="ms-1 rounded-full bg-[#D30A0A] px-1 text-xs font-medium text-white">
                                    {{ $status->orders_count }}
                                </span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 uppercase text-gray-700">
                    <tr>
                        <th class="px-4 py-3">Mã đơn hàng</th>
                        <th class="px-4 py-3">Thông tin khách hàng</th>
                        <th class="px-4 py-3">Tổng số tiền</th>
                        <th class="py-3 md:px-4">Trạng thái</th>
                        <th class="px-4 py-3" scope="col">
                            <span class="sr-only uppercase">Hành động </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="md:px-4 md:py-2">
                                <a class="font-medium text-gray-800 hover:text-red-600" data-modal-target="order-modal-{{ $order->id }}" data-modal-toggle="order-modal-{{ $order->id }}" href="#">#{{ $order->code }}</a>
                            </td>
                            <td class="md:px-4 md:py-2">
                                <a class="mb-2 font-medium text-gray-800 hover:text-red-600" href="{{ route('admin.users.show', $order->user->id) }}">{{ $order->fullname }}</a>
                                <p>{{ $order->address->detail_address }}</p>
                                <p>{{ $order->ward->name_with_type }}, {{ $order->district->name_with_type }},
                                    {{ $order->province->name_with_type }}
                                </p>
                            </td>
                            <td class="md:px-4 md:py-2">
                                {{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}đ
                            </td>
                            <td class="md:px-4 md:py-2">
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
                                <span class="{{ $colorClass }} me-2 mt-1.5 inline-flex shrink-0 items-center rounded px-2.5 py-0.5 text-xs font-medium text-white">
                                    {{ $order->orderStatus->name }}
                                </span>
                            </td>
                            <td class="flex items-center justify-end px-4 py-3">
                                <button class="inline-flex items-center rounded-lg p-0.5 text-center text-sm text-gray-500 hover:text-gray-800 focus:outline-none" data-dropdown-toggle="{{ $order->id }}-dropdown" id="{{ $order->id }}" type="button">
                                    @svg('tabler-dots', 'w-5 h-5')
                                </button>
                                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow" id="{{ $order->id }}-dropdown">
                                    <ul aria-labelledby="{{ $order->id }}" class="py-1 text-sm text-gray-700">
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100" data-modal-target="order-modal-{{ $order->id }}" data-modal-toggle="order-modal-{{ $order->id }}" href="#">Chi tiết </a>
                                        </li>
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('admin.orders.edit', $order->id) }}">Cập nhật
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        {{-- order modal --}}
                        <div aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 md:h-full" id="order-modal-{{ $order->id }}" tabindex="-1">
                            <div class="relative h-auto w-full max-w-5xl p-4">
                                <div class="no-scrollbar relative h-[480px] overflow-y-auto rounded-lg bg-white p-5 shadow md:p-8">
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <h1 class="text-xl font-semibold">Đơn hàng #{{ $order->code }}</h1>
                                            <button class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-hide="order-modal-{{ $order->id }}" type="button">
                                                @svg('tabler-x', 'w-4 h-4')
                                            </button>
                                        </div>
                                        <div class="flex items-center justify-start">
                                            @if ($order->orderStatus->slug === 'completed')
                                                @if ($order->invoice)
                                                    <a href="{{ route('invoices.show', $order->invoice->invoice_number) }}">
                                                        <button class="button-red">Xem hóa đơn</button>
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                        <hr class="w-full">
                                        <div class="rounded-lg pl-4">
                                            <label class="font-semibold">Trạng thái đơn hàng</label>
                                            <p class="{{ $colorClass }} mx-2 mt-1.5 inline-block shrink-0 items-center rounded px-2.5 py-0.5 text-xs font-medium text-white">
                                                {{ $order->orderStatus->name }}
                                            </p>
                                        </div>
                                        {{-- user_id --}}
                                        <div class="rounded-lg pl-4">
                                            <label class="font-semibold">Thông tin thanh toán</label>
                                            <p class="mt-4 text-gray-800">{{ $order->fullname }}</p>
                                            <p class="text-gray-800">{{ $order->address->detail_address }}</p>
                                            <p class="text-gray-800">{{ $order->ward->name_with_type }},
                                                {{ $order->district->name_with_type }},
                                                {{ $order->province->name_with_type }}
                                            </p>
                                        </div>
                                        {{-- Email --}}
                                        <div class="rounded-lg pl-4">
                                            <label class="font-semibold">Email</label>
                                            <p class="text-gray-800">{{ $order->email }}</p>
                                        </div>
                                        {{-- SĐT --}}
                                        <div class="rounded-lg pl-4">
                                            <label class="font-semibold">Số điện thoại</label>
                                            <p class="text-gray-800">{{ $order->phone }}</p>
                                        </div>
                                        {{-- hình thức thanh toán --}}
                                        <div class="rounded-lg pl-4">
                                            <label class="font-semibold">Hình thức thanh toán</label>
                                            <p class="text-gray-800">{{ $order->paymentMethod->name }}</p>
                                        </div>
                                        @if ($order->orderStatus->slug === 'cancelled')
                                            <div class="rounded-lg pl-4">
                                                <label class="font-semibold">Lí do hủy đơn</label>
                                                <p class="text-gray-800">{{ $order->cancelled_reason }}</p>
                                            </div>
                                        @endif
                                        <hr class="w-full">
                                        {{-- SẢN PHẨM --}}
                                        <div class="flex justify-between">
                                            <div class="basic-2/3">
                                                <div class="pl-4">
                                                    <label class="mb-5 text-base font-semibold">Sản phẩm</label> <br>
                                                    @foreach ($order->orderItems as $orderItem)
                                                        <div class="flex items-center whitespace-nowrap py-2 text-gray-900">
                                                            <a class="shrink-0" data-fslightbox="gallery" href="{{ asset('storage/uploads/products/' . $orderItem->product->image) }}">
                                                                <img class="mr-3 h-8 w-8 rounded object-cover" loading="lazy" onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'" src="{{ asset('storage/uploads/products/' . $orderItem->product->image) }}">
                                                            </a>
                                                            <div>
                                                                <div class="grid grid-flow-row">
                                                                    <span class="text-sm">{{ $orderItem->product->name }}</span>
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
                        <td class="py-4 text-center text-base" colspan="6">
                            <div class="flex h-80 w-full flex-col items-center justify-center rounded-lg bg-white p-6">
                                @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                <p class="mt-4 text-sm text-gray-500">Dữ liệu trống</p>
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
