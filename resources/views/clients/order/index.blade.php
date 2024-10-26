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
                        <a class="{{ request()->routeIs('client.order.index') && request('tab') === null ? 'border-[#D30A0A] text-[#D30A0A] ' : 'border-transparent' }} inline-block rounded-t-lg border-b-2 pb-2" href="{{ route('client.order.index') }}">Tất cả</a>
                    </li>
                    @foreach ($orderStatuses as $status)
                        <li class="me-6 min-w-fit">
                            <a class="{{ request()->get('tab') === $status->slug ? 'border-[#D30A0A] text-[#D30A0A] ' : 'border-transparent' }} inline-block rounded-t-lg border-b-2 pb-2" href="{{ route('client.order.index', ['tab' => $status->slug]) }}">{{ $status->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- Danh sách đơn hàng --}}
            @forelse ($orders as $order)

                <div class="product-card mb-4 p-4 hover:cursor-pointer">
                    <div class="" onclick="toggleAccordion({{ $order->id }})">
                        <div class="mb-2 space-y-4 text-sm">
                            <div class="flex items-center">
                                <p class="text-base font-medium text-[#D30A0A]">#LADYBUG-2024{{ $order->id }}</p>
                                <div class="ms-auto space-x-2">
                                    <span class="text-{{ $order->orderStatus->color }}-700 bg-{{ $order->orderStatus->color }}-100 inline-block rounded px-3 py-1 text-xs font-medium">{{ $order->orderStatus->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 flex items-start justify-between">
                            <div class="flex items-center gap-2">
                                @if ($order->orderStatus->slug === 'completed')
                                    <span class="badge-light">{{ \Carbon\Carbon::parse($order->completed_at)->format('H:i:s') }}</span>
                                    <span class="badge-light">{{ \Carbon\Carbon::parse($order->completed_at)->format('d/m/Y') }}</span>
                                @elseif (in_array($order->orderStatus->slug, ['waiting', 'finding_driver', 'shipping', 'confirmed']))
                                    <span class="badge-light">{{ \Carbon\Carbon::parse($order->created_at)->format('H:i:s') }}</span>
                                    <span class="badge-light">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</span>
                                @elseif ($order->orderStatus->slug === 'cancelled')
                                    <span class="badge-light">{{ \Carbon\Carbon::parse($order->canceled_at)->format('H:i:s') }}</span>
                                    <span class="badge-light">{{ \Carbon\Carbon::parse($order->canceled_at)->format('d/m/Y') }}</span>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-light text-gray-600 line-through">
                                    {{ number_format($order->amount + $order->shipping_fee) }}đ</p>
                                <p class="text-base font-medium">
                                    {{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}đ
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-4">
                            @if ($order->orderStatus->name !== 'Hoàn thành' && $order->orderStatus->name !== 'Đã hủy')
                                <a class="link-md"data-modal-target="deleteBanner-modal-{{ $order->id }}" data-modal-toggle="deleteBanner-modal-{{ $order->id }}" href="#">Huỷ đơn</a>
                            @endif
                            @if ($order->orderStatus->name === 'Hoàn thành')
                                @if ($order->invoice)
                                    <a class="link-md" href="{{ route('invoices.show', $order->invoice->invoice_number) }}">
                                        Xem hóa đơn

                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                    {{-- start modal delete --}}
                    <div class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0" id="deleteBanner-modal-{{ $order->id }}" tabindex="-1">
                        <div class="relative max-h-full w-full max-w-md p-2">
                            <div class="relative rounded-lg bg-white shadow">
                                <button class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-hide="deleteBanner-modal-{{ $order->id }}" type="button">
                                    @svg('tabler-x', 'w-4 h-4')
                                    <span class="sr-only">Close modal</span>
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
                                            <input class="mr-2 text-[#D30A0A]" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, false)" type="radio" value="1">
                                            <label class="text-sm">Muốn thay đổi địa chỉ giao hàng</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="mr-2 text-[#D30A0A]" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, false)" type="radio" value="2">
                                            <label class="text-sm">Muốn nhập/thay đổi mã Voucher</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="mr-2 text-[#D30A0A]" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, false)" type="radio" value="3">
                                            <label class="text-sm">Muốn thay đổi sản phẩm trong đơn hàng (size, topping, số
                                                lượng,...)</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="mr-2 text-[#D30A0A]" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, false)" type="radio" value="4">
                                            <label class="text-sm">Thủ tục thanh toán quá rắc rối</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="mr-2 text-[#D30A0A]" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, false)" type="radio" value="5">
                                            <label class="text-sm">Tìm thấy giá rẻ hơn ở chỗ khác</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="mr-2 text-[#D30A0A]" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, false)" type="radio" value="6">
                                            <label class="text-sm">Đổi ý, không muốn mua nữa</label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="mr-2 text-[#D30A0A]" id="otherReason-{{ $order->id }}" name="canceled_reason" onchange="toggleTextarea({{ $order->id }}, true)" type="radio" value="7">
                                            <label class="text-sm" for="otherReason-{{ $order->id }}">Lý do khác
                                                :</label>
                                            <div>
                                                <textarea class="mt-2 w-full rounded-lg border-gray-200 shadow-sm sm:text-sm" disabled id="OrderNotes-{{ $order->id }}" name="reason" placeholder="Nhập lý do..." rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex justify-between">
                                            <button class="rounded-lg bg-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-400" type="button">Không
                                                Phải Bây Giờ</button>
                                            <button class="rounded-lg bg-[#D30A0A] px-4 py-2 text-sm text-white hover:bg-red-800" type="submit">Hủy
                                                Đơn Hàng</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end modal delete --}}
                    <div class="max-h-0 overflow-hidden transition" id="content-{{ $order->id }}">
                        <hr class="my-4">
                        <div class="pb-5 text-sm">
                            <p class="mb-4 text-base font-medium">Thông tin chi tiết</p>
                            <div class="flex items-start justify-between">
                                <div class="mb-4">
                                    <p class="mb-2 font-medium">Phương thức thanh toán</p>
                                    <p>{{ $order->paymentMethod->name }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="mb-2 font-medium">Người nhận</p>
                                    <p>{{ $order->user->fullname }}</p>
                                    <p>{{ $order->user->phone }}</p>
                                    <p>{{ $order->address->ward }}, {{ $order->address->district }},
                                        {{ $order->address->province }}</p>
                                    <p>Ghi chú : {{ $order->address->detail_address }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Danh sách sản phẩm --}}
                        <hr class="my-4">
                        <div class="pb-5 text-sm">
                            <p class="mb-4 text-base font-medium">Danh sách sản phẩm</p>
                            <div class="grid grid-cols-1 gap-4 md:px-4 lg:grid-cols-2">
                                @foreach ($order->orderItems as $orderItem)
                                    @foreach ($orderItem->productAttributes as $products)
                                        <div class="product-card overflow-hidden">
                                            <div class="flex w-full items-center justify-between">
                                                <div class="flex gap-4">
                                                    <img alt="" class="h-32 w-24 object-cover" loading="lazy" src="{{ asset('storage/uploads/products/' . $products->product->image) }}">
                                                    <div class="py-2 text-left">
                                                        <p class="mb-2 font-medium">{{ $products->product->name }}</p>
                                                        <div class="mb-4 text-sm">
                                                            {{-- @dd($products->attributeValue); --}}
                                                            <p>{{ $products->attributeValue->value }}</p>
                                                            <p>Topping:
                                                                {{-- @dd($orderItem->toppings); --}}
                                                                @foreach ($orderItem->toppings as $toppings)
                                                                    {{ $toppings->name }}
                                                                @endforeach
                                                            </p>
                                                        </div>
                                                        <div class="flex items-center gap-2 text-sm">
                                                            <span class="line-through">320,000đ</span>
                                                            <span class="font-medium">300,000đ</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            @empty
            <div class="card flex flex-col items-center justify-center gap-8 p-4 md:p-8">
                @svg('tabler-shopping-bag-exclamation', 'icon-4xl text-gray-400')
                <p class="text-center">Đơn hàng của bạn đang trống</p>
                <a class="button-red" href="{{ route('client.product.menu') }}">Thực đơn</a>
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
