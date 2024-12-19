@extends('layouts.client')

@section('title', 'Lịch sử đơn hàng')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="min-h-screen">
        <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
            <p class="title">LỊCH SỬ ĐƠN HÀNG</p>
            {{-- tabs --}}
            <div class="no-scrollbar mb-4 overflow-x-auto border-b border-gray-200 text-left text-sm">
                <ul class="flex gap-2">
                    <li class="relative mx-4 me-6 mt-3 min-w-fit">
                        <a class="{{ request()->routeIs('client.order.index') && request('tab') === null ? 'border-[#D30A0A] text-[#D30A0A]' : 'border-transparent' }} inline-block rounded-t-lg border-b-2 pb-2"
                           href="{{ route('client.order.index') }}">
                            Tất cả
                        </a>
                        @if ($orderStatuses->sum('orders_count') > 0)
                            <span class="badge-noti -top-2">
                                {{ $orderStatuses->sum('orders_count') }}
                            </span>
                        @endif
                    </li>
                    @foreach ($orderStatuses as $status)
                        <li class="relative me-6 mt-3 min-w-fit">
                            <a class="{{ request()->get('tab') === $status->slug ? 'border-[#D30A0A] text-[#D30A0A] ' : 'border-transparent' }} inline-block rounded-t-lg border-b-2 pb-2"
                               href="{{ route('client.order.index', ['tab' => $status->slug]) }}">{{ $status->name }}
                            </a>
                            {{--                            <span class="badge-noti -top-2">--}}
                            {{--                                {{ $status->orders_count > 0 ? $status->orders_count : 0 }}--}}
                            {{--                            </span>--}}
                            @if($status->orders_count > 0)
                                <span class="badge-noti -top-2"> {{$status->orders_count}} </span>
                            @endif
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
                            <dd class="mt-1.5 text-base font-semibold text-[#D30A0A]">
                                #{{ $order->code }}
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
                                {{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}đ
                            </dd>
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
                                    class="{{ $colorClass }} me-2 mt-1.5 inline-flex shrink-0 items-center rounded px-2.5 py-0.5 text-xs font-medium text-white">
                                    {{ $order->orderStatus->name }}
                                </span>
                            </dd>
                        </dl>

                        <div class="grid w-full gap-2 sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end">
                            @if ($order->orderStatus->slug == 'waiting')
                                <button class="button-red w-full" data-modal-target="cancelOrder-modal-{{ $order->id }}"
                                        data-modal-toggle="cancelOrder-modal-{{ $order->id }}" type="button">Huỷ
                                    đơn hàng
                                </button>
                            @endif

                            @if ($order->orderStatus->slug == 'delivered')
                                <button class="button-red w-full"
                                        data-modal-target="confirmReceived-modal-{{ $order->id }}"
                                        data-modal-toggle="confirmReceived-modal-{{ $order->id }}" type="button">
                                    Đã nhận hàng
                                </button>
                            @endif

                            @if ($order->orderStatus->slug === 'completed')
                                <div class="flex items-center gap-2">
                                    @if ($order->evaluations->isEmpty())
                                        <button class="button-red w-full"
                                                data-modal-target="reviewOrder-modal-{{ $order->id }}"
                                                data-modal-toggle="reviewOrder-modal-{{ $order->id }}" type="button">
                                            @svg('tabler-star', 'w-4 h-4')
                                        </button>
                                    @endif
                                    <a class="button-light w-full" target="_blank"
                                       href="{{ route('invoices.show', $order->invoice->invoice_number) }}"
                                       type="button">
                                        @svg('tabler-file-invoice', 'w-4 h-4')
                                    </a>
                                </div>
                            @endif
                            <button class="button-light" onclick="toggleAccordion({{ $order->id }})" type="button">
                                @svg('tabler-info-circle', 'w-4 h-4')
                            </button>

                        </div>
                    </div>

                    {{-- Đã nhận được hàng --}}
                    <div
                        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
                        id="confirmReceived-modal-{{ $order->id }}" tabindex="-1">
                        <div class="relative max-h-full w-full max-w-md p-4">
                            <div class="relative rounded-lg bg-white shadow">
                                <button
                                    class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
                                    data-modal-hide="confirmReceived-modal-{{ $order->id }}" type="button">
                                    @svg('tabler-x', 'w-4 h-4')
                                </button>
                                <div class="p-10 text-center">
                                    <div class="flex justify-center">
                                        @svg('tabler-checks', 'w-12 h-12 text-green-600 text-center mb-2')
                                    </div>
                                    <h3 class="mb-7 font-normal">
                                        Bạn có chắc chắn đã nhận được hàng?
                                    </h3>

                                    <form action="{{ route('client.order.received', $order) }}"
                                          class="flex items-center justify-center" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="button-red" type="submit">
                                            Xác nhận đã nhận hàng
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Hủy đơn hàng --}}
                    <div
                        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
                        id="cancelOrder-modal-{{ $order->id }}" tabindex="-1">
                        <div
                            class="card max-h-sm md:max-h-sm lg:max-h-lg relative max-w-[350px] md:max-w-[500px] lg:max-w-lg">
                            <div class="relative rounded-lg bg-white shadow">
                                <button
                                    class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
                                    data-modal-hide="cancelOrder-modal-{{ $order->id }}" type="button">
                                    @svg('tabler-x', 'w-4 h-4')
                                </button>
                                {{-- lý do hủy --}}
                                <div class="rounded-lg bg-white p-5 shadow-md">
                                    <h2 class="mb-4 text-xl font-semibold">Chọn Lý Do Hủy Đơn Hàng</h2>
                                    <p class="mb-2 text-sm text-gray-600">
                                        Vui lòng chọn lý do hủy. Với lý do này, bạn sẽ hủy tất cả sản phẩm trong đơn
                                        hàng và
                                        không thể thay đổi sau đó.
                                    </p>

                                    <form action="{{ route('client.order.cancel', $order) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-2">
                                            <input class="mr-1 text-[#D30A0A] focus:ring-0" name="cancelled_reason"
                                                   onchange="toggleTextarea({{ $order->id }}, false)" type="radio"
                                                   value="1">
                                            <label class="text-sm">Muốn thay đổi địa chỉ giao hàng</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="mr-1 text-[#D30A0A] focus:ring-0" name="cancelled_reason"
                                                   onchange="toggleTextarea({{ $order->id }}, false)" type="radio"
                                                   value="2">
                                            <label class="text-sm">Muốn nhập/thay đổi mã Voucher</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="mr-1 text-[#D30A0A] focus:ring-0" name="cancelled_reason"
                                                   onchange="toggleTextarea({{ $order->id }}, false)" type="radio"
                                                   value="3">
                                            <label class="text-sm">Muốn thay đổi sản phẩm trong đơn hàng (size,
                                                topping,...)</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="mr-1 text-[#D30A0A] focus:ring-0" name="cancelled_reason"
                                                   onchange="toggleTextarea({{ $order->id }}, false)" type="radio"
                                                   value="4">
                                            <label class="text-sm">Thủ tục thanh toán quá rắc rối</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="mr-1 text-[#D30A0A] focus:ring-0" name="cancelled_reason"
                                                   onchange="toggleTextarea({{ $order->id }}, false)" type="radio"
                                                   value="5">
                                            <label class="text-sm">Tìm thấy giá rẻ hơn ở chỗ khác</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="mr-1 text-[#D30A0A] focus:ring-0" name="cancelled_reason"
                                                   onchange="toggleTextarea({{ $order->id }}, false)" type="radio"
                                                   value="6">
                                            <label class="text-sm">Đổi ý, không muốn mua nữa</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="mr-1 text-[#D30A0A] focus:ring-0"
                                                   id="otherReason-{{ $order->id }}" name="cancelled_reason"
                                                   onchange="toggleTextarea({{ $order->id }}, true)" type="radio"
                                                   value="7">
                                            <label class="text-sm" for="otherReason-{{ $order->id }}">Lý do khác
                                                :</label>
                                            <div>
                                                <textarea
                                                    class="mt-2 w-full rounded-lg border-gray-200 shadow-sm sm:text-sm"
                                                    disabled
                                                    id="OrderNotes-{{ $order->id }}" name="reason"
                                                    placeholder="Nhập lý do..." rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex justify-between">
                                            <button button class="button-gray"
                                                    data-modal-hide="cancelOrder-modal-{{ $order->id }}"
                                                    type="button">Không Phải Bây Giờ
                                            </button>
                                            <button class="button-red" type="submit">Hủy Đơn Hàng</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Đánh giá đơn hàng --}}
                    <div
                        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0"
                        id="reviewOrder-modal-{{ $order->id }}" tabindex="-1">
                        <div class="card relative max-h-full w-full max-w-4xl">
                            <div class="relative rounded-lg bg-white">
                                <button
                                    class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
                                    data-modal-hide="reviewOrder-modal-{{ $order->id }}" type="button">
                                    @svg('tabler-x', 'w-4 h-4')
                                </button>
                                <div class="rounded-lg bg-white p-5 shadow-md">
                                    <h2 class="mb-4 text-xl font-semibold">Đánh giá sản phẩm</h2>

                                    <div class="grid grid-cols-1 gap-4">
                                        <!-- Hiển thị các sản phẩm sau khi đã nhóm -->
                                        <form action="{{ route('client.order.evaluation', $order) }}"
                                              enctype="multipart/form-data" method="POST">
                                            @csrf
                                            @foreach ($order->orderItems as $orderItem)
                                                <div class="mb-4 rounded-lg border-2 border-gray-300 p-5">
                                                    <div class="product-card relative w-auto overflow-hidden text-sm">
                                                        <div class="flex w-full items-center justify-between">
                                                            <div class="flex gap-4">
                                                                <img alt="" class="h-auto w-24 object-cover"
                                                                     class="mr-3 h-8 w-8 rounded bg-slate-400 object-cover"
                                                                     loading="lazy"
                                                                     onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'"
                                                                     src="{{ asset('storage/uploads/products/' . $orderItem->product->image) }}">
                                                                <div class="py-2 text-left md:min-w-[300px]">
                                                                    <p class="mb-2 font-medium">
                                                                        {{ $orderItem->product->name }}
                                                                    </p>
                                                                    <div class="mb-4 text-sm">
                                                                        @if ($orderItem->atrributeValues->count() > 0)
                                                                            <p>{{ $orderItem->atrributeValues->map->value->join(', ') }}
                                                                            </p>
                                                                        @endif
                                                                        @if ($orderItem->toppingValues->count() > 0)
                                                                            <p>Topping:
                                                                                {{ $orderItem->toppingValues->map->name->join(', ') }}
                                                                            </p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-rating-{{ $orderItem->product->id }}">
                                                        {{-- Đánh giá sao --}}
                                                        @error('ratings.' . $orderItem->product->id)
                                                        <p class="mt-3 text-center text-sm text-[#D30A0A]">
                                                            {{ $message }}</p>
                                                        @enderror
                                                        <div class="my-3 flex items-center justify-center"
                                                             id="rating-star-{{ $orderItem->product->id }}" F>
                                                            <div class="rating-group inline-flex hover:text-[#D30A0A]">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <label aria-label="{{ $i }} star"
                                                                           class="rating__label cursor-pointer p-1"
                                                                           for="rating_{{ $orderItem->product->id }}_{{ $i }}">
                                                                        <i
                                                                            class="rating__icon--star pointer-events-none text-[#D30A0A] group-hover:text-[#D30A0A]">
                                                                            @svg('tabler-star-filled', 'icon-lg')
                                                                        </i>
                                                                    </label>
                                                                    <input @if ($i === 5) checked @endif
                                                                    class="rating__input"
                                                                           id="rating_{{ $orderItem->product->id }}_{{ $i }}"
                                                                           name="ratings[{{ $orderItem->product->id }}]"
                                                                           type="radio" value="{{ $i }}"/>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        {{-- Comment --}}
                                                        <div class="mb-4">
                                                            <textarea class="text-area resize-none text-sm"
                                                                      name="comments[{{ $orderItem->product->id }}]"
                                                                      placeholder="Viết đánh giá..."
                                                                      rows="6"></textarea>
                                                            @error('comments.' . $orderItem->product->id)
                                                            <p class="pt-2 text-sm text-[#D30A0A]">{{ $message }}
                                                            </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="mt-4 flex items-center justify-end">
                                                <button class="button-red" type="submit">Đánh
                                                    giá sản phẩm
                                                </button>
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
                        @if ($order->orderStatus->name === 'completed' && $order->invoice)
                            <div class="mb-4 flex">
                                <a class="button-red"
                                   href="{{ route('invoices.show', $order->invoice->invoice_number) }}">Xem hóa
                                    đơn</a>
                            </div>
                        @endif
                        <div>
                            <p class="mb-4 text-base font-medium">Địa chỉ nhận hàng</p>
                            <div class="mb-4 flex items-start justify-between text-sm">
                                <div>
                                    <p>{{ $order->user->fullname }}</p>
                                    <p>{{ $order->user->phone }}</p>
                                    <p>{{ $order->address->detail_address }}</p>
                                    <p>{{ $order->ward->name_with_type }}, {{ $order->district->name_with_type }},
                                        {{ $order->province->name_with_type }}</p>
                                    @if ($order->notes)
                                        <p><strong>Ghi chú :</strong> {{ $order->notes }}</p>
                                    @endif
                                </div>

                            </div>
                        </div>

                        {{-- Danh sách sản phẩm --}}
                        <hr class="my-4">
                        <div class="pb-5 text-sm">
                            <p class="mb-4 text-base font-medium">Danh sách sản phẩm</p>
                            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                                <!-- Hiển thị các sản phẩm sau khi đã nhóm -->
                                @foreach ($order->orderItems as $orderItem)
                                    <a href="{{ route('client.product.show', $orderItem->product->slug) }}">
                                        <div class="product-card relative w-auto overflow-hidden">
                                            <div class="flex w-full items-center justify-between">
                                                <div class="flex gap-4">
                                                    <img alt="" class="h-auto w-24 object-cover"
                                                         class="mr-3 h-8 w-8 rounded bg-slate-400 object-cover"
                                                         loading="lazy"
                                                         onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'"
                                                         src="{{ asset('storage/uploads/products/' . $orderItem->product->image) }}">
                                                    <div class="py-2 text-left md:min-w-[300px]">
                                                        <p class="mb-2 font-medium">{{ $orderItem->product->name }}
                                                            <span
                                                                class="ps-2 text-[#D30A0A]">x{{ $orderItem->quantity }}</span>
                                                        </p>
                                                        <div class="mb-4 text-sm">
                                                            @if ($orderItem->atrributeValues->count() > 0)
                                                                <p>{{ $orderItem->atrributeValues->map->value->join(', ') }}
                                                                </p>
                                                            @endif
                                                            @if ($orderItem->toppingValues->count() > 0)
                                                                <p>Topping:
                                                                    {{ $orderItem->toppingValues->map->name->join(', ') }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span
                                                class="absolute bottom-0 right-0 p-2 font-medium text-[#D30A0A]">{{ number_format($orderItem->quantity * $orderItem->price) }}₫</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="pb-5 text-sm">
                            <div class="flex items-start justify-between gap-3">
                                <div class="mb-4">
                                </div>
                                <div class="text-right">
                                    <div>
                                        <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                                            <p class="text-start">Tạm tính</p>
                                            <p class="text-end font-medium">{{ number_format($order->amount) }}₫</p>
                                        </div>
                                        <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                                            <p class="text-start">Phí vận chuyển</p>
                                            <p class="text-end font-medium">{{ number_format($order->shipping_fee) }}
                                                ₫</p>
                                        </div>
                                        <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                                            <p class="text-start">Giảm giá</p>
                                            <p class="text-end font-medium">{{ number_format($order->discount_amount) }}
                                                ₫
                                            </p>
                                        </div>
                                        <hr class="mb-2">
                                        <div class="mb-4 flex items-center justify-between gap-32">
                                            <p class="text-start text-sm">Tổng tiền</p>
                                            <p class="text-end font-medium text-[#D30A0A]">
                                                {{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}
                                                ₫
                                            </p>
                                        </div>
                                        <hr class="mb-2">
                                        <div class="mb-4 flex items-center justify-between gap-32">
                                            <p class="text-start text-sm">Phương thức thanh toán</p>
                                            <p class="text-end font-medium">
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
            <div class="p-4">
                {{ $orders->onEachSide(1)->appends(request()->query())->links() }}
            </div>
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
