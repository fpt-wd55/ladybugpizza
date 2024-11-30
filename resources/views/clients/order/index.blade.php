@extends('layouts.client')

@section('title', 'Lịch sử đơn hàng')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="min-h-screen">
        <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
            <p class="title">LỊCH SỬ ĐƠN HÀNG</p>
            {{-- tabs --}}
            <div class="no-scrollbar mb-4 overflow-x-auto border-b border-gray-200 text-left text-sm">
                <ul class="flex">
                    <li class="me-6 min-w-fit">
                        <a class="inline-block rounded-t-lg border-b-2 pb-2 {{ request()->routeIs('client.order.index') && request('tab') === null ? 'border-[#D30A0A] text-[#D30A0A] ' : 'border-transparent' }}"
                            href="{{ route('client.order.index') }}">Tất cả <span
                                class="text-[#D30A0A]">({{ $orderStatuses->sum('orders_count') }})</span></a>
                    </li>
                    @foreach ($orderStatuses as $status)
                        <li class="me-6 min-w-fit">
                            <a class="inline-block rounded-t-lg border-b-2 pb-2 {{ request()->get('tab') === $status->slug ? 'border-[#D30A0A] text-[#D30A0A] ' : 'border-transparent' }}"
                                href="{{ route('client.order.index', ['tab' => $status->slug]) }}">{{ $status->name }}
                                ({{ $status->orders_count }})
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- Danh sách đơn hàng --}}
            @forelse ($orders as $order)
                <div class="product-card mb-4 p-4 hover:cursor-pointer ">
                    <div class="flex flex-wrap items-center gap-y-4">
                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-sm text-gray-500">Mã đơn hàng:
                            </dt>
                            <dd class="mt-1.5 text-base font-semibold text-[#D30A0A]">
                                #{{ $order->id }}
                            </dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-sm text-gray-500">Ngày đặt hàng:
                            </dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                {{ $order->created_at }}</dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-sm text-gray-500">Tổng đơn hàng:
                            </dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900">
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
                                <span
                                    class="me-2 mt-1.5 inline-flex shrink-0 items-center rounded px-2.5 py-0.5 text-xs font-medium text-white  {{ $colorClass }}">
                                    {{ $order->orderStatus->name }}
                                </span>
                            </dd>
                        </dl>

                        <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                            @if ($order->orderStatus->name == 'Chờ xác nhận')
                                <button type="button" data-modal-target="cancelOrder-modal-{{ $order->id }}"
                                    data-modal-toggle="cancelOrder-modal-{{ $order->id }}" class="button-red">Huỷ
                                    đơn hàng</button>
                            @endif

                            @if ($order->orderStatus->name === 'Hoàn thành' && $order->evaluations->isEmpty())
                                <button type="button" data-modal-target="reviewOrder-modal-{{ $order->id }}"
                                    data-modal-toggle="reviewOrder-modal-{{ $order->id }}" class="button-red">Đánh
                                    giá</button>
                            @endif

                            <button type="button" onclick="toggleAccordion({{ $order->id }})"
                                class="button-light">
                            @svg('tabler-info-circle', 'w-4 h-4')
                            </button>
                        </div>
                    </div>

                    {{-- Hủy đơn hàng --}}
                    <div id="cancelOrder-modal-{{ $order->id }}" tabindex="-1"
                        class="hidden  overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div
                            class="card relative max-w-[350px] max-h-sm md:max-w-[500px] md:max-h-sm lg:max-w-lg lg:max-h-lg">
                            <div class="relative bg-white rounded-lg shadow">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="cancelOrder-modal-{{ $order->id }}">
                                    @svg('tabler-x', 'w-4 h-4')
                                    <span class="sr-only">Close modal</span>
                                </button>
                                {{-- lý do hủy --}}
                                <div class="p-5 bg-white rounded-lg shadow-md">
                                    <h2 class="text-xl font-semibold mb-4">Chọn Lý Do Hủy Đơn Hàng</h2>
                                    <p class="text-sm text-gray-600 mb-4">
                                        Vui lòng chọn lý do hủy. Với lý do này, bạn sẽ hủy tất cả sản phẩm trong đơn
                                        hàng và
                                        không thể thay đổi sau đó.
                                    </p>
                                    <form action="{{ route('client.order.cancel', $order) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-2">
                                            <input type="radio" name="canceled_reason" value="1"
                                                class="mr-1 text-[#D30A0A] focus:ring-0"
                                                onchange="toggleTextarea({{ $order->id }}, false)">
                                            <label class="text-sm">Muốn thay đổi địa chỉ giao hàng</label>
                                        </div>
                                        <div class="mb-2">
                                            <input type="radio" name="canceled_reason" value="2"
                                                class="mr-1 text-[#D30A0A] focus:ring-0"
                                                onchange="toggleTextarea({{ $order->id }}, false)">
                                            <label class="text-sm">Muốn nhập/thay đổi mã Voucher</label>
                                        </div>
                                        <div class="mb-2">
                                            <input type="radio" name="canceled_reason" value="3"
                                                class="mr-1 text-[#D30A0A] focus:ring-0"
                                                onchange="toggleTextarea({{ $order->id }}, false)">
                                            <label class="text-sm">Muốn thay đổi sản phẩm trong đơn hàng (size,
                                                topping,...)</label>
                                        </div>
                                        <div class="mb-2">
                                            <input type="radio" name="canceled_reason" value="4"
                                                class="mr-1 text-[#D30A0A] focus:ring-0"
                                                onchange="toggleTextarea({{ $order->id }}, false)">
                                            <label class="text-sm">Thủ tục thanh toán quá rắc rối</label>
                                        </div>
                                        <div class="mb-2">
                                            <input type="radio" name="canceled_reason" value="5"
                                                class="mr-1 text-[#D30A0A] focus:ring-0"
                                                onchange="toggleTextarea({{ $order->id }}, false)">
                                            <label class="text-sm">Tìm thấy giá rẻ hơn ở chỗ khác</label>
                                        </div>
                                        <div class="mb-2">
                                            <input type="radio" name="canceled_reason" value="6"
                                                class="mr-1 text-[#D30A0A] focus:ring-0"
                                                onchange="toggleTextarea({{ $order->id }}, false)">
                                            <label class="text-sm">Đổi ý, không muốn mua nữa</label>
                                        </div>
                                        <div class="mb-2">
                                            <input type="radio" id="otherReason-{{ $order->id }}"
                                                name="canceled_reason" value="7"
                                                class="mr-1 text-[#D30A0A] focus:ring-0"
                                                onchange="toggleTextarea({{ $order->id }}, true)">
                                            <label class="text-sm" for="otherReason-{{ $order->id }}">Lý do khác
                                                :</label>
                                            <div>
                                                <textarea id="OrderNotes-{{ $order->id }}" name="reason"
                                                    class="mt-2 w-full rounded-lg border-gray-200 shadow-sm sm:text-sm" rows="4" placeholder="Nhập lý do..."
                                                    disabled></textarea>
                                            </div>
                                        </div>
                                        <div class="flex justify-between mt-4">
                                            <button button data-modal-hide="cancelOrder-modal-{{ $order->id }}"
                                                type="button" class="button-gray">Không
                                                Phải Bây Giờ</button>
                                            <button type="submit" class="button-red">Hủy
                                                Đơn Hàng</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Đánh giá đơn hàng --}}
                    <div id="reviewOrder-modal-{{ $order->id }}" tabindex="-1"
                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="card relative w-full max-w-4xl max-h-full">
                            <div class="relative bg-white rounded-lg ">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="reviewOrder-modal-{{ $order->id }}">
                                    @svg('tabler-x', 'w-4 h-4')
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-5 bg-white rounded-lg shadow-md">
                                    <h2 class="text-xl font-semibold mb-4">Đánh giá sản phẩm</h2>

                                    <div class="grid grid-cols-1 gap-4">
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
                                                $groupedProducts[$key] = [
                                                    'product' => $orderItem->product,
                                                    'attribute' => $attributeValue,
                                                    'toppings' => $toppings,
                                                ];
                                            }
                                        @endphp

                                        <!-- Hiển thị các sản phẩm sau khi đã nhóm -->
                                        <form action="{{ route('client.order.evaluation', $order) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @foreach ($groupedProducts as $group)
                                                <div class="border-2 border-gray-300 rounded-lg p-5 mb-4">
                                                    <div class="product-card overflow-hidden w-auto relative text-sm">
                                                        <div class="flex w-full items-center justify-between">
                                                            <div class="flex gap-4">
                                                                <img alt="" class="h-auto w-24 object-cover"
                                                                    loading="lazy"
                                                                    src="{{ asset('storage/uploads/products/' . $group['product']->image) }}"
                                                                    onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'"
                                                                    class="w-8 h-8 mr-3 rounded bg-slate-400 object-cover">
                                                                <div class="py-2 text-left md:min-w-[300px]">
                                                                    <p class="mb-2 font-bold">
                                                                        {{ $group['product']->name }}
                                                                    </p>
                                                                    <div class="mb-4 text-sm">
                                                                        <p>{{ $group['attribute'] }}</p>
                                                                        <p>Topping: {{ $group['toppings'] }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-rating-{{ $group['product']->id }}">
                                                        {{-- Đánh giá sao --}}
                                                        @error('ratings.' . $group['product']->id)
                                                            <p class="text-center text-sm text-[#D30A0A] mt-3">
                                                                {{ $message }}</p>
                                                        @enderror
                                                        <div id="rating-star-{{ $group['product']->id }}"F
                                                            class="flex justify-center items-center my-3">
                                                            <div class="rating-group inline-flex hover:text-[#D30A0A]">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <label aria-label="{{ $i }} star"
                                                                        class="rating__label cursor-pointer p-1"
                                                                        for="rating_{{ $group['product']->id }}_{{ $i }}">
                                                                        <i
                                                                            class="rating__icon--star text-[#D30A0A] group-hover:text-[#D30A0A] pointer-events-none">
                                                                            @svg('tabler-star-filled', 'icon-lg')
                                                                        </i>
                                                                    </label>
                                                                    <input class="rating__input"
                                                                        name="ratings[{{ $group['product']->id }}]"
                                                                        id="rating_{{ $group['product']->id }}_{{ $i }}"
                                                                        value="{{ $i }}" type="radio"
                                                                        @if ($i === 5) checked @endif />
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        {{-- Comment --}}
                                                        <div class="mb-4">
                                                            <textarea rows="6" name="comments[{{ $group['product']->id }}]" class="text-area text-sm resize-none"
                                                                placeholder="Viết đánh giá..."></textarea>
                                                            @error('comments.' . $group['product']->id)
                                                                <p class="text-sm text-[#D30A0A] pt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="flex justify-end items-center mt-4">
                                                <button type="submit" class="button-red">Đánh
                                                    giá sản phẩm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Chi tiết đơn hàng --}}
                    <div class="max-h-0 overflow-hidden transition" id="content-{{ $order->id }}">
                        <hr class="my-4">
                        @if ($order->orderStatus->name === 'Hoàn thành' && $order->invoice)
                            <div class="mb-4 flex">
                                <a href="{{ route('invoices.show', $order->invoice->invoice_number) }}"
                                    class="button-red">Xem hóa
                                    đơn</a>
                            </div>
                        @endif
                        <div>
                            <p class="mb-4 text-base font-medium">Địa chỉ nhận hàng</p>
                            <div class="flex items-start justify-between mb-4 text-sm">
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
                                    <a href="{{ route('client.product.show', $group['product']->slug) }}">
                                        <div class="product-card overflow-hidden w-auto relative">
                                            <div class="flex w-full items-center justify-between">
                                                <div class="flex gap-4">
                                                    <img alt="" class="h-auto w-24 object-cover" loading="lazy"
                                                        src="{{ asset('storage/uploads/products/' . $group['product']->image) }}"
                                                        onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'"
                                                        class="w-8 h-8 mr-3 rounded bg-slate-400 object-cover">
                                                    <div class="py-2 text-left md:min-w-[300px]">
                                                        <p class="mb-2 font-medium">{{ $group['product']->name }}</p>
                                                        <div class="mb-4 text-sm">
                                                            <p>{{ $group['attribute'] }}</p>
                                                            <p>Topping: {{ $group['toppings'] }}</p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <span
                                                class="absolute bottom-0 right-0 text-[#D30A0A] font-medium p-2">x{{ $group['quantity'] }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="pb-5 text-sm">
                            <div class="flex items-start justify-between">
                                <div class="mb-4">
                                    <p class="mb-4 text-base font-medium">Ghi chú đơn hàng</p>
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
                <div class="card flex flex-col items-center justify-center gap-8 p-4 md:p-8 min-h-96 text-gray-500">
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
