@extends('layouts.shared')

@section('title', 'Hoá đơn ' . $invoice->invoice_number)

@section('style')
    <style>
        @media print {
            page-break-inside: avoid;

            body * {
                visibility: hidden;
                -webkit-print-color-adjust: exact;
            }

            #content-invoice,
            #content-invoice * {
                visibility: visible;
                /* Hiển thị phần cần in */
            }

            #content-invoice {
                position: absolute;
                border: none !important;
                top: 0;
                left: 0;
                width: 100%;
            }

            @page {
                size: A4;
                margin: 20px;
            }

            body {
                margin: 0;
            }
        }
    </style>
@endsection

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="mb-8 flex items-center justify-between">
            <p class="title">Hoá đơn</p>
            <button class="button-red" id="print" onclick="print()" data-invoice-number="{{ $invoice->invoice_number }}">
                @svg('tabler-printer', 'icon-sm md:icon-md md:me-2')
                <span class="hidden md:inline-block">In hoá đơn</span>
            </button>
        </div>
        <div class="card p-4 md:p-8 text-sm" id="content-invoice">
            <div class="flex justify-between mb-4 md:mb-8">
                <div>
                    <p class="title">LadybugPizza</p>
                    <div>
                        <p>Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô</p>
                        <p>Phường Phương Canh, Quận Nam Từ Liêm, Thành phố Hà Nội</p>
                        <p>ladybugpizza@gmail.com</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="title">{{ $user->fullname }}</p>
                    <div>
                        <p>{{ $order->address->detail_address }}</p>
                        <p>{{ $order->ward->name_with_type . ', ' . $order->district->name_with_type . ', ' . $order->province->name_with_type }}
                        </p>
                        <p>{{ $user->email }}</p>
                    </div>
                </div>
            </div>
            <div class="mb-4 md:md-8">
                <p class="title">Hoá đơn {{ $invoice->invoice_number }}</p>
            </div>
            <div>
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left title-sm">STT</th>
                            <th class="text-left title-sm">Sản phẩm</th>
                            <th class="text-right title-sm">Số lượng</th>
                            <th class="text-right title-sm">Đơn giá</th>
                            <th class="text-right title-sm">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $item)
                            <tr class="border-b">
                                <td class="text-left py-3">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-left py-3">
                                    <p class="font-medium">{{ $item->product->name }}</p>
                                    <p class="font-light">
                                        {{ implode(', ', $item->attributes->pluck('attribute_value.value')->toArray()) }}
                                    </p>
                                    @if (isset($item->toppings) && count($item->toppings) > 0)
                                        <p class="font-light">Topping:
                                            {{ implode(', ', $item->toppings->pluck('topping.name')->toArray()) }}</p>
                                    @endif
                                </td>
                                <td class="text-right py-3">{{ $item->quantity }}</td>
                                <td class="text-right py-3">{{ number_format($item->price) }}đ</td>
                                <td class="text-right py-3">
                                    {{ number_format($item->quantity * $item->price) }}đ</td>
                            </tr>
                        @endforeach
                        <tr class="border-b">
                            <td colspan="4" class="text-right font-semibold py-3">Tạm tính</td>
                            <td class="text-right py-3">{{ number_format($order->amount) }}đ</td>
                        </tr>
                        <tr class="border-b">
                            <td colspan="4" class="text-right font-semibold py-3">Phí vận chuyển</td>
                            <td class="text-right py-3">{{ number_format($order->shipping_fee) }}đ</td>
                        </tr>
                        <tr class="border-b">
                            <td colspan="4" class="text-right font-semibold py-3">Giảm giá</td>
                            <td class="text-right py-3">
                                {{ number_format($order->discount_amount ? $order->discount_amount : '0') }}đ</td>
                        </tr>
                        <tr class="border-b">
                            <td colspan="4" class="text-right font-semibold py-3 uppercase">Tổng thanh toán</td>
                            <td class="text-right py-3">
                                {{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}đ</td>
                        </tr>
                        <tr class="border-b">
                            <td colspan="4" class="text-right font-semibold py-3 uppercase">Phương thức thanh toán</td>
                            <td class="text-right py-3">{{ $order->paymentMethod->name }}</td>
                        </tr>
                    </tbody>
                </table>

                <p class="text-center mt-6">Cảm ơn bạn rất nhiều đã đặt hàng tại Ladybug Pizza. Chúng tôi mong được gặp lại
                    bạn một lần nữa!</p>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('print').addEventListener('click', function() {
            window.print();
        });
    </script>
@endsection
