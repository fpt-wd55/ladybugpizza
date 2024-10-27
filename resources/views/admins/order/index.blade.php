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
                <a href="{{ route('admin.orders.export') }}"
                    class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0">
                    @svg('tabler-file-export', 'w-4 h-4 mr-2')
                    Xuất dữ liệu
                </a>
            </div>
        </div>
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4 border-t">
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <div class="flex items-center space-x-3 w-full md:w-full">
                    <div class="flex items-center w-full">
                        <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                            class="w-full md:w-auto flex items-center justify-center py-2 ps-2 pe-3 me-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                            type="button">
                            @svg('tabler-chevron-down', 'w-5 h-5 me-3')
                            Hành động
                        </button>
                        <h2 class="font-medium text-gray-700 text-base italic" id="selectedItems">
                        </h2>
                    </div>
                    <div id="actionsDropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Kích hoạt/Khóa</a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Xóa tài khoản</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <form class="flex w-full md:w-40 lg:w-64" action="{{ route('admin.users.search') }}">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            @svg('tabler-search', 'w-5 h-5 text-gray-400')
                        </div>
                        <input type="text" name="search" class="input ps-10" placeholder="Tìm kiếm..." />
                    </div>
                </form>
                <div class="flex items-center space-x-3 w-full md:w-auto">
                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                        type="button">
                        @svg('tabler-filter-filled', 'w-5 h-5 me-2')
                        Bộ lọc
                        @svg('tabler-chevron-down', 'w-5 h-5 ms-3')
                    </button>
                    <div id="filterDropdown" class="z-10 hidden w-96 p-3 bg-white rounded-lg shadow">
                        <form action="#" aria-labelledby="filterDropdownButton">
                            <h6 class="mb-3 text-sm font-medium text-gray-900">Vai trò</h6>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <input id="admin" type="checkbox" value="filter-role-admin"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="admin" class="ml-2 text-sm font-medium text-gray-900">Quản trị
                                        viên</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="client" type="checkbox" value="filter-role-client"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="client" class="ml-2 text-sm font-medium text-gray-900">Khách hàng</label>
                                </li>
                            </ul>
                            <h6 class="my-3 text-sm font-medium text-gray-900">Giới tính</h6>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <input id="male" type="checkbox" value="filter-gender-male"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="male" class="ml-2 text-sm font-medium text-gray-900">Nam</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="female" type="checkbox" value="filter-gender-female"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="female" class="ml-2 text-sm font-medium text-gray-900">Nữ</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="other" type="checkbox" value="filter-gender-other"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="other" class="ml-2 text-sm font-medium text-gray-900">Khac</label>
                                </li>
                            </ul>
                            <h6 class="my-3 text-sm font-medium text-gray-900">Trạng thái</h6>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <input id="active" type="checkbox" value="filter-status-active"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="active" class="ml-2 text-sm font-medium text-gray-900">Hoạt động</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="inactive" type="checkbox" value="filter-status-inactive"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                    <label for="inactive" class="ml-2 text-sm font-medium text-gray-900">Khóa</label>
                                </li>
                            </ul>
                            <h6 class="my-3 text-sm font-medium text-gray-900">Ngày sinh</h6>
                            <div class="flex items-center">
                                <div>
                                    <input name="filter-birthday-start" type="date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                        placeholder="mm/dd/yyyy">
                                </div>
                                <span class="mx-4 text-gray-500">-</span>
                                <div>
                                    <input name="filter-birthday-end" type="date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                        placeholder="mm/dd/yyyy">
                                </div>
                            </div>
                            <h6 class="my-3 text-sm font-medium text-gray-900">Ngày tham gia</h6>
                            <div class="flex items-center">
                                <div>
                                    <input name="filter-created-start" type="date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                        placeholder="mm/dd/yyyy">
                                </div>
                                <span class="mx-4 text-gray-500">-</span>
                                <div>
                                    <input name="filter-created-end" type="date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full ps-3 p-2"
                                        placeholder="mm/dd/yyyy">
                                </div>
                            </div>

                            <button type="submit" class="button-red w-full mt-5">
                                Lọc
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 border-b bg-gray-50">
            <!-- Các tab điều hướng -->
            <ul class="flex">
                <li class="me-6 min-w-fit">
                    <a aria-current="page" class="inline-block rounded-t-lg border-b-2 border-red-600 pb-2 text-red-600"
                        href="{{ route('admin.orders.index') }}">Tất cả</a>
                </li>
                @foreach ($orderStatuses as $status)
                    <li class="me-6 min-w-fit">
                        <a aria-current="page" class="inline-block rounded-t-lg border-b-2 border-transparent pb-2"
                            href="{{ route('admin.orders.index', ['tab' => $status->slug]) }}">{{ $status->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        {{--  --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="bg-gray-50 text-gray-700 uppercase">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="table-checkbox-all" type="checkbox"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                            </div>
                        </th>
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
                            <div class="flex items-center">
                                <input id="table-item-checkbox-{{ $order->id }}" type="checkbox"
                                    onclick="event.stopPropagation()"
                                    class="table-item-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                            </div>
                            </td>
                            <td class="px-4 py-2">{{ $order->user->fullname }}</td>
                            <td class="px-4 py-2">
                                <p>{{ $order->address->detail_address }}</p>
                                <p>{{ $order->address->ward }}, {{ $order->address->district }},
                                    {{ $order->address->province }}</p>
                            </td>
                            <td class="px-4 py-2">{{ number_format($order->amount) }}đ</td>
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
                                                        @if ($order->invoice)
                                                            <a
                                                                href="{{ route('invoices.show', $order->invoice->invoice_number) }}">
                                                                <button class="mt-4 button-red">Xem hóa đơn</button>
                                                            </a>
                                                        @endif
                                                    @endif
                                                    @php
                                                        // Xác định màu sắc dựa trên trạng thái đơn hàng
                                                        $buttonClass = match ($order->orderStatus->name) {
                                                            'Hoàn thành' => 'button-green',
                                                            'Đang giao hàng' => 'button-gray',
                                                            'Đang tìm tài xế' => 'button-gray',
                                                            'Chờ xác nhận' => 'button-yellow',
                                                            'Đã xác nhận' => 'button-blue',
                                                            'Đã hủy' => 'button-gray',
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
                                                    {{-- sản phẩm --}}
                                                    <div class="pl-4 ">
                                                        <label class="font-semibold">Sản phẩm</label> <br>
                                                        @foreach ($order->orderItems as $orderItem)
                                                            @foreach ($orderItem->productAttributes as $products)
                                                                <span class="text-gray-800 font-semibold">
                                                                    {{ $products->product->name }} ,
                                                                </span>
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                    {{-- thuộc tính --}}
                                                    <div class="pl-4 ">
                                                        <span>Đế : </span>
                                                        @foreach ($order->orderItems as $orderItem)
                                                            @foreach ($orderItem->productAttributes as $attribute)
                                                                {{ $attribute->attributeValue->value }},
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                    {{-- topping --}}
                                                    <div class="pl-4 ">
                                                        <span>Topping : </span>
                                                        @foreach ($order->orderItems as $orderItem)
                                                            @foreach ($orderItem->toppings as $topping)
                                                                {{ $topping->name }},
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="font-semibold">Tổng tiền thanh toán</label>
                                                    <p>{{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}đ
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex justify-end">
                                                <a href="{{ route('admin.orders.edit', $order->id) }}">
                                                    <button class="button-blue">Cập nhật</button>
                                                </a>
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
