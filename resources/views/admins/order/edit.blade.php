@extends('layouts.admin')
@section('title', 'Cập nhật đơn hàng')

@section('content')
    {{ Breadcrumbs::render('admin.orders.edit') }}
    <div class="mt-5 bg-white shadow sm:rounded-lg overflow-hidden">
        <div class="container mx-auto p-6 ml-4">
            <h1 class="text-2xl font-semibold mb-4">Đặt hàng</h1>
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="grid grid-cols-3 gap-4">
                {{-- Giá trị 1 --}}
                <div>
                    <h2 class="text-lg font-semibold mb-4">Tổng quan</h2>
                    <label class="font-semibold">Ngày tạo</label>
                    <p class="mb-4">{{ $order->created_at }}</p>
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="w-[80%]">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="status" class="block mb-2 font-semibold">Trạng thái</label>
                            <select class="select" name="status" id="status" class="border-gray-300 rounded w-full p-2">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}"
                                        {{ $order->orderStatus->name === $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex justify-start gap-2 mt-6">
                            <button type="submit" class="button-red">Cập nhật</button>
                            <a href="{{ route('admin.orders.index') }}" class="button-gray">Quay lại</a>
                        </div>
                    </form>
                </div>
                {{-- Giá trị 2 --}}
                <div>
                    <h3 class="text-lg font-semibold mb-2">Thanh toán</h3>
                    <p>{{ $order->user->fullname }}</p>
                    <p>{{ $order->address->detail_address }}</p>
                    <p class="mb-2">{{ $order->address->ward }}, {{ $order->address->district }},
                        {{ $order->address->province }}</p>
                    <label class="font-semibold">Địa chỉ email</label>
                    <p class="mb-2">{{ $order->user->email }}</p>
                    <label class="font-semibold">Số điện thoại</label>
                    <p>{{ $order->user->phone }}</p>

                </div>
                {{-- Giá trị 3 --}}
                <div>
                    <h4 class="text-lg font-semibold mb-2">Giao hàng</h4>
                    <p>{{ $order->user->fullname }}</p>
                    <p>{{ $order->address->detail_address }}</p>
                    <p class="mb-2">{{ $order->address->ward }}, {{ $order->address->district }},
                        {{ $order->address->province }}</p>
                    <label class="font-semibold">Ghi chú</label>
                    <p class="mb-2">{{ $order->notes }}</p>
                </div>
            </div>
            <hr class="w-full my-4">
            {{-- SẢN PHẨM --}}
            <div class="grid grid-cols-2">
                {{-- sản phẩm --}}
                <div>
                    <label class="font-semibold mb-5">Sản phẩm</label> <br>
                    @foreach ($order->orderItems as $orderItem)
                        <div class="flex items-center py-2 text-gray-900 whitespace-nowrap">
                            <a class="shrink-0" data-fslightbox="gallery"
                                href="{{ asset('storage/uploads/products/' . $orderItem->product->image) }}">
                                <img loading="lazy"
                                    src="{{ asset('storage/uploads/products/' . $orderItem->product->image) }}"
                                    onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'"
                                    class="w-8 h-8 mr-3 rounded object-cover">
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
                {{-- thanh toán --}}
                <div class="ml-36">
                    <div class="flex items-center justify-between mb-2 gap-32 text-sm">
                        <p class="">Tổng tiền sản phẩm</p>
                        <p class="font-medium">{{ number_format($order->amount) }}₫</p>
                    </div>
                    <div class="flex items-center justify-between mb-2 gap-32 text-sm">
                        <p class="">Phí vận chuyển</p>
                        <p class="font-medium">{{ number_format($order->shipping_fee) }}₫</p>
                    </div>
                    <div class="flex items-center justify-between mb-2 gap-32 text-sm">
                        <p class="">Giảm giá</p>
                        <p class="font-medium">{{ number_format($order->discount_amount) }}₫</p>
                    </div>
                    <hr class="mb-2">
                    <div class="flex items-center justify-between gap-32">
                        <p class="font-medium">Tổng tiền thanh toán</p>
                        <p class="font-medium">
                            {{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}₫</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
