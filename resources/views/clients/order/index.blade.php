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
                            <p class="text-base font-medium text-[#D30A0A]">#LADYBUG-2024{{$order->id}}</p>
                            <div class="ms-auto space-x-2">
                                <span class="inline-block px-3 py-1 text-sm font-semibold text-{{$order->orderStatus->color}}-700 bg-{{$order->orderStatus->color}}-100 rounded-full">{{ $order->orderStatus->name }}</span>
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
                            <p class="font-light text-sm text-gray-600 line-through">{{ number_format($order->amount + $order->shipping_fee) }}đ</p>
                            <p class="text-base font-medium">{{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}đ</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-4">
                        <a class="link-md" href="#">Huỷ đơn</a>
                        <a class="link-md" href="#">Xem hoá đơn</a>
                    </div>
                </div>
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
                                <p>{{ $order->address->ward }}, {{ $order->address->district }}, {{ $order->address->province }}</p>
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
                                            <img alt="" class="h-32 w-24 object-cover" loading="lazy" src="{{ asset('storage/uploads/products/'.$products->product->image) }}">
                                            <div class="py-2 text-left">
                                                <p class="mb-2 font-medium">{{$products->product->name}}</p>
                                                <div class="mb-4 text-sm">
                                                    @dd($products->attributeValue);
                                                    <p>{{$products->attributeValue->value}}</p>
                                                    <p>Topping: Thịt bò, cá hồi</p>
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
    </script>
@endsection
