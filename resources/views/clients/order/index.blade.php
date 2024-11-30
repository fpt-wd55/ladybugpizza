@extends('layouts.client')

@section('title', 'Lịch sử đơn hàng')
@section('content')
    <div class="min-h-screen">
        <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
            <p class="title">LỊCH SỬ ĐƠN HÀNG</p>
            {{-- tabs --}}
            <div class="no-scrollbar mb-4 overflow-x-auto border-b border-gray-200 text-left text-sm">
                <ul class="flex">
                    <li class="me-6 min-w-fit">
                        <a class="{{ request()->routeIs('client.order.index') && request('tab') === null ? 'border-[#D30A0A] text-[#D30A0A] ' : 'border-transparent' }} inline-block rounded-t-lg border-b-2 pb-2" href="{{ route('client.order.index') }}">Tất cả <span class="text-[#D30A0A]">({{ $orderStatuses->sum('orders_count') }})</span></a>
                    </li>
                    @foreach ($orderStatuses as $status)
                        <li class="me-6 min-w-fit">
                            <a class="{{ request()->get('tab') === $status->slug ? 'border-[#D30A0A] text-[#D30A0A] ' : 'border-transparent' }} inline-block rounded-t-lg border-b-2 pb-2" href="{{ route('client.order.index', ['tab' => $status->slug]) }}">{{ $status->name }}
                                ({{ $status->orders_count }})
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- Danh sách đơn hàng --}}
            @forelse ($orders as $order)
                <div class="product-card mb-4 p-4 hover:cursor-pointer">
                    <div class="flex flex-wrap items-center gap-y-4">
                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-sm text-gray-500">Mã đơn hàng:
                            </dt>
                            <dd class="mt-1.5 text-sm font-medium text-[#D30A0A]">
                                #{{ $order->id }}
                            </dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-sm text-gray-500">Thời gian đặt hàng:
                            </dt>
                            <dd class="mt-1.5 text-sm font-medium text-gray-900">
                                {{ $order->created_at }}</dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-sm text-gray-500">Tổng đơn hàng:
                            </dt>
                            <dd class="mt-1.5 text-sm font-medium text-gray-900">
                                {{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}đ</dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-sm text-gray-500">Trạng thái:
                            </dt>
                            <dd>
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
                            </dd>
                        </dl>

                        <div class="grid w-full gap-4 sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end">
                            @if ($order->orderStatus->name == 'Chờ xác nhận')
                                <button class="button-red" data-modal-target="deleteBanner-modal-{{ $order->id }}" data-modal-toggle="deleteBanner-modal-{{ $order->id }}" type="button">Huỷ
                                    đơn hàng</button>
                            @endif
                            @if ($order->orderStatus->name === 'Hoàn thành')
                                @if ($order->invoice)
                                    <a class="button-red" href="{{ route('invoices.show', $order->invoice->invoice_number) }}">Xem hóa đơn</a>
                                @endif
                            @endif
                            <button class="hover:text-primary-700 inline-flex w-full justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 transition hover:bg-gray-100 focus:z-10 focus:outline-none focus:ring-0 lg:w-auto" onclick="toggleAccordion({{ $order->id }})" type="button">
                                @svg('tabler-info-circle', 'w-4 h-4')
                            </button>
                        </div>
                    </div>

                    {{-- Hủy đơn hàng --}}
                    <div class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0" id="deleteBanner-modal-{{ $order->id }}" tabindex="-1">
                        <div class="card max-h-sm md:max-h-sm lg:max-h-lg relative max-w-[350px] md:max-w-[500px] lg:max-w-lg">
                            <div class="relative rounded-lg bg-white shadow">
                                <button class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-hide="deleteBanner-modal-{{ $order->id }}" type="button">
                                    @svg('tabler-x', 'w-4 h-4')
                                </button>
                                {{-- lý do hủy --}}
                                <div class="rounded-lg bg-white p-5 shadow-md">
                                    <h2 class="mb-4 text-xl font-semibold">Chọn Lý Do Hủy Đơn Hàng</h2>
                                    <p class="mb-4 text-sm text-gray-600">
                                        Vui lòng chọn lý do hủy. Với lý do này, bạn sẽ hủy tất cả sản phẩm trong đơn hàng và
                                        không thể thay đổi sau đó.
                                    </p>
                                    <form action="{{ route('client.order.cancel', $order) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-2">
                                            <input class="input-radio" id="reason-1" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, false)" type="radio" value="1">
                                            <label class="text-sm" for="reason-1">Muốn thay đổi địa chỉ giao hàng</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="input-radio" id="reason-2" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, false)" type="radio" value="2">
                                            <label class="text-sm" for="reason-2">Muốn nhập/thay đổi mã Voucher</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="input-radio" id="reason-3" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, false)" type="radio" value="3">
                                            <label class="text-sm" for="reason-3">Muốn thay đổi sản phẩm trong đơn hàng (size,
                                                topping,...)</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="input-radio" id="reason-4" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, false)" type="radio" value="4">
                                            <label class="text-sm" for="reason-4">Thủ tục thanh toán quá rắc rối</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="input-radio" id="reason-5" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, false)" type="radio" value="5">
                                            <label class="text-sm" for="reason-5">Tìm thấy giá rẻ hơn ở chỗ khác</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="input-radio" id="reason-6" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, false)" type="radio" value="6">
                                            <label class="text-sm" for="reason-6">Đổi ý, không muốn mua nữa</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="input-radio" id="otherReason-{{ $order->id }}" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, true)" type="radio" value="7">
                                            <label class="text-sm" for="otherReason-{{ $order->id }}">Lý do khác :</label>
                                            <div class="mt-2">
                                                <textarea class="text-area" disabled id="OrderNotes-{{ $order->id }}" name="reason" placeholder="Nhập lý do..." rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex justify-between gap-4">
                                            <button class="button-red w-full" type="submit">Hủy đơn hàng</button>
                                            <button button class="button-dark w-full" data-modal-hide="deleteBanner-modal-{{ $order->id }}" type="button">Không phải bây giờ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Chi tiết đơn hàng --}}
                    <div class="max-h-0 overflow-hidden transition" id="content-{{ $order->id }}">
                        <hr class="my-4">
                        <div>
                            <p class="mb-4 text-base font-medium">Địa chỉ nhận hàng</p>
                            <div class="mb-4 flex items-start justify-between text-sm">
                                <div>
                                    <p>{{ $order->user->fullname }}</p>
                                    <p>{{ $order->user->phone }}</p>
                                    <p>{{ $order->address->ward }}, {{ $order->address->district }},
                                        {{ $order->address->province }}</p>
                                    <p>{{ $order->address->detail_address }}</p>
                                    @if ($order->notes)
                                        <p>Ghi chú : {{ $order->notes }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Danh sách sản phẩm --}}
                        <hr class="my-4">
                        <div class="pb-5 text-sm">
                            <p class="mb-4 text-base font-medium">Danh sách sản phẩm</p>
                            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                                @php
                                    // Tạo một mảng để nhóm các sản phẩm theo tên, thuộc tính và topping
                                    $groupedProducts = [];
                                    // Lặp qua từng sản phẩm và nhóm chúng
                                    foreach ($order->orderItems as $orderItem) {
                                        $productName = $orderItem->product->name;
                                        $attributeValue = $orderItem->atrributeValues->map->value->join(', ');
                                        $toppings = $orderItem->toppingValues->map->name->join(', ');
                                        // Tạo một key duy nhất để nhóm các sản phẩm trùng nhau
                                        $key = $productName . '|' . $attributeValue . '|' . $toppings;
                                        // Nếu key đã tồn tại, tăng số lượng; nếu không, thêm vào mảng
                                        if (isset($groupedProducts[$key])) {
                                            $groupedProducts[$key]['quantity'] += 1;
                                        } else {
                                            $groupedProducts[$key] = [
                                                'product' => $orderItem->product,
                                                'attribute' => $attributeValue,
                                                'toppings' => $toppings,
                                                'quantity' => 1,
                                                'price' => $orderItem->product->price,
                                                'discount_price' => $orderItem->product->discount_price,
                                            ];
                                        }
                                    }
                                @endphp

                                <!-- Hiển thị các sản phẩm sau khi đã nhóm -->
                                @foreach ($groupedProducts as $group)
                                    <div class="product-card relative w-auto overflow-hidden">
                                        <div class="flex w-full items-center justify-between">
                                            <div class="flex gap-4">
                                                <img alt="" class="h-32 w-24 object-cover" class="mr-3 h-8 w-8 rounded bg-slate-400 object-cover" loading="lazy" onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'" src="{{ asset('storage/uploads/products/' . $group['product']->image) }}">
                                                <div class="py-2 text-left md:min-w-[300px]">
                                                    <p class="mb-2 font-medium">{{ $group['product']->name }}</p>
                                                    <div class="mb-4 text-sm">
                                                        <p>{{ $group['attribute'] }}</p>
                                                        <p>Topping: {{ $group['toppings'] }}</p>
                                                    </div>
                                                    <div class="flex items-center gap-2 text-sm">
                                                        <span class="line-through">{{ number_format($group['discount_price']) }}đ</span>
                                                        <span class="font-medium">{{ number_format($group['price']) }}đ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="absolute bottom-0 right-0 p-2 font-medium text-[#D30A0A]">x{{ $group['quantity'] }}</span>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="pb-5 text-sm">
                            <div class="flex items-start justify-between">
                                <div class="mb-4">
                                    <p>Ghi chú đơn hàng</p>
                                    <p>{{ $order->notes }}</p>
                                </div>
                                <div class="text-right">
                                    <div>
                                        <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                                            <p>Tạm tính</p>
                                            <p class="font-medium">{{ number_format($order->amount) }}₫</p>
                                        </div>
                                        <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                                            <p>Phí vận chuyển</p>
                                            <p class="font-medium">{{ number_format($order->shipping_fee) }}₫</p>
                                        </div>
                                        <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                                            <p>Giảm giá</p>
                                            <p class="font-medium">{{ number_format($order->discount_amount) }}₫</p>
                                        </div>
                                        <hr class="mb-2">
                                        <div class="mb-4 flex items-center justify-between gap-32">
                                            <p class="text-sm">Tổng tiền</p>
                                            <p class="font-medium text-[#D30A0A]">
                                                {{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}₫
                                            </p>
                                        </div>
                                        <hr class="mb-2">
                                        <div class="mb-4 flex items-center justify-between gap-32">
                                            <p class="text-sm">Phương thức thanh toán</p>
                                            <p class="font-medium">
                                                {{ $order->paymentMethod->name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            @empty
                <div class="card min-h-96 flex flex-col items-center justify-center gap-8 p-4 text-gray-500 md:p-8">
                    @svg('tabler-truck-off', 'icon-xl')
                    <p class="text-center">Đơn hàng của bạn đang trống</p>
                </div>
            @endforelse

        </div>
    </div>

    <script>
        function toggleAccordion(index) {
            const content = document.getElementById(`content-${index}`);

            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                content.style.maxHeight = '0';
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        }

        function toggleTextarea(orderId, enable) {
            const textarea = document.getElementById("OrderNotes-" + orderId);
            textarea.disabled = !enable;

            if (enable) {
                textarea.focus();
            } else {
                textarea.value = "";
            }
        }
    </script>
@endsection
