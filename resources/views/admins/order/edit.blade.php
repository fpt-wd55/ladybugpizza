@extends('layouts.admin')
@section('title', 'Cập nhật đơn hàng')

@section('content')
    {{ Breadcrumbs::render('admin.orders.edit') }}
    <div class="mt-5 overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="container mx-auto ml-4 p-6">
            <h1 class="mb-4 text-2xl font-semibold">Đặt hàng</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Giá trị 1 --}}
                <div>
                    <h2 class="mb-4 text-lg font-semibold">Tổng quan</h2>
                    <label class="font-semibold">Ngày tạo</label>
                    <p class="mb-4">{{ $order->created_at }}</p>
                    <form action="{{ route('admin.orders.update', $order->id) }}" class="w-[80%]" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="mb-2 block font-semibold" for="status">Trạng thái</label>
                            <select class="input" id="status" name="status">
                                @foreach ($statuses as $status)
                                    <option
                                        {{ old('status', $order->orderStatus->slug) === $status->slug ? 'selected' : '' }}
                                        value="{{ $status->slug }}"
                                        {{ in_array($order->orderStatus->slug, ['shipping', 'delivered', 'completed']) && $status->slug === 'cancelled' ? 'disabled' : '' }}
                                        {{ $order->orderStatus->id > $status->id ? 'disabled' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4" id="cancelled_reason">
                            <p class="mb-2 text-sm font-normal">Lý do hủy đơn: <span class="text-red-600">*</span> </p>
                            <textarea class="text-area" name="cancelled_reason" rows="4">{{ $order->cancelled_reason ?? null }}</textarea>
                            @error('cancelled_reason')
                                <p class="pt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-6 flex justify-start gap-2">
                            <button class="button-red" type="submit">Cập nhật</button>
                            <a class="button-gray" href="{{ route('admin.orders.index') }}">Quay lại</a>
                        </div>
                    </form>
                </div>
                {{-- Giá trị 2 --}}
                <div>
                    <h3 class="mb-2 text-lg font-semibold">Thanh toán</h3>
                    <p>{{ $order->fullname }}</p>
                    <p>{{ $order->address->detail_address }}</p>
                    <p class="mb-2">{{ $order->ward->name_with_type }},
                        {{ $order->district->name_with_type }},
                        {{ $order->province->name_with_type }}</p>
                    <label class="font-semibold">Địa chỉ email</label>
                    <p class="mb-2">{{ $order->email }}</p>
                    <label class="font-semibold">Số điện thoại</label>
                    <p>{{ $order->phone }}</p>

                </div>
                {{-- Giá trị 3 --}}
                <div>
                    <h4 class="mb-2 text-lg font-semibold">Giao hàng</h4>
                    <label class="font-semibold">Phương thức thanh toán</label>
                    <p class="mb-2">{{ $order->paymentMethod->name }}</p>
                    @if ($order->notes)
                        <label class="font-semibold">Ghi chú</label>
                        <p class="mb-2">{{ $order->notes }}</p>
                    @endif
                </div>
            </div>
            <hr class="my-4 w-full">
            {{-- SẢN PHẨM --}}
            <div class="grid grid-cols-1 md:grid-cols-2">
                {{-- sản phẩm --}}
                <div>
                    <label class="mb-5 font-semibold">Sản phẩm</label> <br>
                    @foreach ($order->orderItems as $orderItem)
                        <div class="flex items-center whitespace-nowrap py-2 text-gray-900">
                            <a class="shrink-0" data-fslightbox="gallery"
                                href="{{ asset('storage/uploads/products/' . $orderItem->product->image) }}">
                                <img class="mr-3 h-8 w-8 rounded object-cover" loading="lazy"
                                    onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'"
                                    src="{{ asset('storage/uploads/products/' . $orderItem->product->image) }}">
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
                <div class="mt-5 md:mt-0 md:ml-36">
                    <div class="mb-2 flex items-center justify-between gap-32 text-sm">
                        <p class="">Tạm tính</p>
                        <p class="font-medium">{{ number_format($order->amount) }}₫</p>
                    </div>
                    <div class="mb-2 flex items-center justify-between gap-32 text-sm">
                        <p class="">Phí vận chuyển</p>
                        <p class="font-medium">{{ number_format($order->shipping_fee) }}₫</p>
                    </div>
                    <div class="mb-2 flex items-center justify-between gap-32 text-sm">
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
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const permissionSelect = document.getElementById('cancelled_reason');

            function toggleForm() {
                if (statusSelect.value === 'cancelled') {
                    permissionSelect.style.display = 'block';
                } else {
                    permissionSelect.style.display = 'none';
                }
 
                setTimeout(() => {
                    permissionSelect.style.transition = 'all 0.5s';
                }, 100);
            }

            statusSelect.addEventListener('change', function() {
                toggleForm();
            });

            toggleForm();
        });
    </script>
@endsection
