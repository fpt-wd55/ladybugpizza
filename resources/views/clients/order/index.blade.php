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
                        <a class="inline-block rounded-t-lg border-b-2 pb-2 {{ request()->routeIs('client.order.index') && request('tab') === null ? 'border-[#D30A0A] text-[#D30A0A] ' : 'border-transparent' }}"
                            href="{{ route('client.order.index') }}">Tất cả</a>
                    </li>
                    @foreach ($orderStatuses as $status)
                        <li class="me-6 min-w-fit">
                            <a class="inline-block rounded-t-lg border-b-2 pb-2 {{ request()->get('tab') === $status->slug ? 'border-[#D30A0A] text-[#D30A0A] ' : 'border-transparent' }}"
                                href="{{ route('client.order.index', ['tab' => $status->slug]) }}">{{ $status->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- Danh sách đơn hàng --}}
            @forelse ($orders as $order)

                <div class="product-card mb-4 p-4 hover:cursor-pointer ">
                    <div class="" onclick="toggleAccordion({{ $order->id }})">
                        <div class="mb-2 space-y-4 text-sm">
                            <div class="flex items-center">
                                <p class="text-base font-medium text-[#D30A0A]">#LADYBUG-2024{{ $order->id }}</p>
                                <div class="ms-auto space-x-2">
                                    <span
                                        class="inline-block px-3 py-1 text-sm font-semibold text-{{ $order->orderStatus->color }}-700 bg-{{ $order->orderStatus->color }}-100 rounded-full">{{ $order->orderStatus->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 flex items-start justify-between">
                            <div class="flex items-center gap-2">
                                @if ($order->orderStatus->slug === 'completed')
                                    <span
                                        class="badge-light">{{ \Carbon\Carbon::parse($order->completed_at)->format('H:i:s') }}</span>
                                    <span
                                        class="badge-light">{{ \Carbon\Carbon::parse($order->completed_at)->format('d/m/Y') }}</span>
                                @elseif (in_array($order->orderStatus->slug, ['waiting', 'finding_driver', 'shipping', 'confirmed']))
                                    <span
                                        class="badge-light">{{ \Carbon\Carbon::parse($order->created_at)->format('H:i:s') }}</span>
                                    <span
                                        class="badge-light">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</span>
                                @elseif ($order->orderStatus->slug === 'cancelled')
                                    <span
                                        class="badge-light">{{ \Carbon\Carbon::parse($order->canceled_at)->format('H:i:s') }}</span>
                                    <span
                                        class="badge-light">{{ \Carbon\Carbon::parse($order->canceled_at)->format('d/m/Y') }}</span>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="font-light text-sm text-gray-600 line-through">
                                    {{ number_format($order->amount + $order->shipping_fee) }}đ</p>
                                <p class="text-base font-medium">
                                    {{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}đ
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-4">
                            @if ($order->orderStatus->name !== 'Hoàn thành' && $order->orderStatus->name !== 'Đã hủy')
                                <a class="link-md"data-modal-target="deleteBanner-modal-{{ $order->id }}"
                                    data-modal-toggle="deleteBanner-modal-{{ $order->id }}" href="#">Huỷ đơn</a>
                            @endif
                            @if ($order->orderStatus->name === 'Hoàn thành')
                                @if ($order->invoice)
                                    <a class="link-md"
                                        href="{{ route('invoices.show', $order->invoice->invoice_number) }}">
                                        Xem hóa đơn

                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                    {{-- start modal delete --}}
                    <div id="deleteBanner-modal-{{ $order->id }}" tabindex="-1"
                        class="hidden  overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="card relative w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="deleteBanner-modal-{{ $order->id }}">
                                    @svg('tabler-x', 'w-4 h-4')
                                    <span class="sr-only">Close modal</span>
                                </button>
                                {{-- lý do hủy --}}
                                <div class="p-5 bg-white rounded-lg shadow-md">
                                    <h2 class="text-xl font-semibold mb-4">Chọn Lý Do Hủy Đơn Hàng</h2>
                                    <p class="text-sm text-gray-600 mb-4">
                                        Vui lòng chọn lý do hủy. Với lý do này, bạn sẽ hủy tất cả sản phẩm trong đơn hàng và
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
                                            <label class="text-sm">Muốn thay đổi sản phẩm trong đơn hàng (size, topping, số
                                                lượng,...)</label>
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
                                            <button button data-modal-hide="deleteBanner-modal-{{ $order->id }}"
                                                type="button"
                                                class="text-sm px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg">Không
                                                Phải Bây Giờ</button>
                                            <button type="submit"
                                                class="text-sm px-4 py-2 bg-[#D30A0A] hover:bg-red-800 text-white rounded-lg">Hủy
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
                                @php
                                    // Tạo một mảng để nhóm các sản phẩm theo tên, thuộc tính và topping
                                    $groupedProducts = [];
                                    // Lặp qua từng sản phẩm và nhóm chúng
                                    foreach ($order->orderItems as $orderItem) {
                                        foreach ($orderItem->productAttributes as $products) {
                                            $productName = $products->product->name;
                                            $attributeValue = $products->attributeValue->value;
                                            $toppings = $orderItem->toppings->pluck('name')->sort()->join(', ');
                                            // Tạo một key duy nhất để nhóm các sản phẩm trùng nhau
                                            $key = $productName . '|' . $attributeValue . '|' . $toppings;
                                            // Nếu key đã tồn tại, tăng số lượng; nếu không, thêm vào mảng
                                            if (isset($groupedProducts[$key])) {
                                                $groupedProducts[$key]['quantity'] += 1;
                                            } else {
                                                $groupedProducts[$key] = [
                                                    'product' => $products->product,
                                                    'attribute' => $attributeValue,
                                                    'toppings' => $toppings,
                                                    'quantity' => 1,
                                                    'price' =>  $products->product->price,
                                                    'discount_price' => $products->product->discount_price,
                                                ];
                                            }
                                        }
                                    }
                                @endphp

                                <!-- Hiển thị các sản phẩm sau khi đã nhóm -->
                                @foreach ($groupedProducts as $group)
                                    <div class="product-card overflow-hidden">
                                        <div class="flex w-full items-center justify-between">
                                            <div class="flex gap-4">
                                                <img alt="" class="h-auto w-24 object-cover" loading="lazy"
                                                    src="{{ asset('storage/uploads/products/' . $group['product']->image) }}">
                                                <div class="py-2 text-left">
                                                    <p class="mb-2 font-medium">{{ $group['product']->name }}</p>
                                                    <div class="mb-4 text-sm">
                                                        <p>{{ $group['attribute'] }}</p>
                                                        <p>Topping: {{ $group['toppings'] }}</p>
                                                    </div>
                                                    <div class="flex items-center gap-2 text-sm">
                                                        <span
                                                            class="line-through">{{ number_format($group['discount_price']) }}đ</span>
                                                        <span
                                                            class="font-medium">{{ number_format($group['price']) }}đ</span>
                                                        <span class="ml-auto mr-4 text-[#D30A0A] font-medium">x{{ $group['quantity'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            @empty
                <div class="card flex flex-col items-center justify-center gap-8 p-4 md:p-8">
                    @svg('tabler-shopping-cart-off', 'icon-4xl text-gray-400')
                    <p class="text-center text-[#D30A0A]">Đơn hàng của bạn đang trống</p>
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
