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
    <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
        <div class="mb-8 flex items-center justify-between">
            <p class="title">Hoá đơn</p>
            <button class="button-red" data-invoice-number="{{ $invoice->invoice_number }}" id="print" onclick="print()">
                @svg('tabler-printer', 'icon-sm md:icon-md md:me-2')
                <span class="hidden md:inline-block">In hoá đơn</span>
            </button>
        </div>
        <div class="card p-4 text-sm md:p-8" id="content-invoice">
            <div class="mb-4 flex justify-between md:mb-8">
                <div>
                    <p class="title">LadybugPizza</p>
                    <div>
                        <p>Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô</p>
                        <p>Phường Phương Canh, Quận Nam Từ Liêm, Thành phố Hà Nội</p>
                        <p>ladybugpizza@gmail.com</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="title">{{ $order->fullname }}</p>
                    <div>
                        <p>{{ $order->address->detail_address }}</p>
                        <p>{{ $order->ward->name_with_type }},
                            {{ $order->district->name_with_type }},
                            {{ $order->province->name_with_type }}</p>
                        <p>{{ $order->email }}</p>
                        <p>{{ $order->phone ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="md:md-8 mb-4">
                <p class="title">Hoá đơn số #{{ $invoice->invoice_number }}</p>
                <p class="title">Mã đơn hàng #{{ $invoice->order->code }}</p>
            </div>
            <div>
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="font-medium text-left">STT</th>
                            <th class="font-medium text-left">Sản phẩm</th>
                            <th class="font-medium text-right">Số lượng</th>
                            <th class="font-medium text-right">Đơn giá</th>
                            <th class="font-medium text-right">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $orderItem)
                            <tr class="border-b">
                                <td class="py-3 text-left">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="py-3 text-left">
                                    <p class="font-medium">{{ $orderItem->product->name }}</p>
                                    @if ($orderItem->atrributeValues->count() > 0)
                                        <p class="font-light">
                                            {{ $orderItem->atrributeValues->map->value->join(', ') }}
                                        </p>
                                    @endif
                                    @if ($orderItem->toppingValues->count() > 0)
                                        <p class="font-light">Topping:
                                            {{ $orderItem->toppingValues->map->name->join(', ') }}
                                        </p>
                                    @endif
                                </td>
                                <td class="py-3 text-right">{{ $orderItem->quantity }}</td>
                                <td class="py-3 text-right">{{ number_format($orderItem->price) }}đ</td>
                                <td class="py-3 text-right">
                                    {{ number_format($orderItem->quantity * $orderItem->price) }}đ
                                </td>
                            </tr>
                        @endforeach
                        <tr class="border-b">
                            <td class="h-24"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 text-right font-semibold" colspan="4">Tạm tính</td>
                            <td class="py-3 text-right">{{ number_format($order->amount) }}đ</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 text-right font-semibold" colspan="4">Phí vận chuyển</td>
                            <td class="py-3 text-right">{{ number_format($order->shipping_fee) }}đ</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 text-right font-semibold" colspan="4">Giảm giá</td>
                            <td class="py-3 text-right">
                                {{ number_format($order->discount_amount ? $order->discount_amount : '0') }}đ
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 text-right font-semibold uppercase" colspan="4">Tổng thanh toán</td>
                            <td class="py-3 text-right">
                                {{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}đ
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 text-right font-semibold uppercase" colspan="4">Phương thức thanh toán</td>
                            <td class="py-3 text-right">{{ $order->paymentMethod->name }}</td>
                        </tr>
                    </tbody>
                </table>

                <p class="mt-6 text-center">Cảm ơn bạn rất nhiều đã đặt hàng tại Ladybug Pizza. Chúng tôi mong được gặp
                    lại
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
