@extends('layouts.client')

@section('title', 'Cảm ơn bạn đã mua hàng')

@section('content')
    <section class="bg-white py-8 antialiased md:py-16">
        <div class="mx-auto max-w-2xl px-4 2xl:px-0">
            <h2 class="text-xl md:text-lg font-semibold text-green-600 mb-2">Cảm ơn bạn đã đặt hàng!</h2>
            <p class="text-gray-500 mb-6 md:mb-8">Đơn hàng số <span class="text-[#D30A0A]">#{{ $order->id }}</span> sẽ được
                xử lý trong vòng 24
                giờ trong ngày
                làm việc. Chúng tôi sẽ thông báo cho bạn qua email khi đơn hàng của bạn đã được chuyển đi.</p>
            <div class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-6 mb-6 md:mb-8">
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500">Ngày đặt hàng</dt>
                    <dd class="font-medium text-gray-900 sm:text-end">{{ $order->created_at }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500">Phương thức thanh toán</dt>
                    <dd class="font-medium text-gray-900 sm:text-end">{{ $order->paymentMethod->name }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500">Tên khách hàng</dt>
                    <dd class="font-medium text-gray-900 sm:text-end">{{ $order->fullname }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500">Địa chỉ</dt>
                    <dd class="font-medium text-gray-900 sm:text-end">
                        <p class="text-end">{{ $order->address->detail_address }}</p>
                        <p class="text-end">{{ $order->ward->name_with_type }}, {{ $order->district->name_with_type }},
                            {{ $order->province->name_with_type }}</p>
                    </dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500">Số điện thoại</dt>
                    <dd class="font-medium text-gray-900 sm:text-end">{{ $order->phone }}</dd>
                </dl>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('client.order.index') }}" class="button-red">Quản lý đơn hàng</a>
                <a href="{{ route('client.product.menu') }}" class="button-light">Tiếp
                    tục mua hàng</a>

            </div>
    </section>
@endsection
