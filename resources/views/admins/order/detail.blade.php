@extends('layouts.admin')
@section('title', 'Chi tiết hóa đơn')

@section('content')
    <div class="mx-10">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Chi tiết hóa đơn</h2>
        <div>
            <a href="" class="button-default ms-auto text-gray-800">Xem hóa đơn</a>
        </div>
        <div class="space-y-4">
            {{--  --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Tên người dùng</label>
                <span class="text-gray-800">{{ $orders->user->fullname }}</span>
            </div>
            {{--  --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Mã giảm giá</label>
                @isset($orders->promotion->code)
                    {{ $orders->promotion->code }}
                @else
                    Không
                @endisset
            </div>
            {{--  --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Tổng số tiền</label>
                <span class="text-gray-800">{{ $orders->amount }}</span>
            </div>
            {{--  --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Địa chỉ</label>
                <span class="text-gray-800">{{ $orders->address->detail_address }}</span>
            </div>
            {{--  --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Giá trị giảm giá</label>
                <span class="text-gray-800">{{ $orders->discount_amount }}</span>
            </div>
            {{--  --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Phí giao hàng</label>
                <span class="text-gray-800">{{ $orders->shipping_fee }}</span>
            </div>
            {{-- --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Hoàn thành</label>
                <span class="text-gray-800">{{ $orders->completed_at }}</span>
            </div>
            {{--  --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Ghi chú</label>
                <span class="text-gray-800">{{ $orders->notes }}</span>
            </div>
            {{-- --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Hình thức thanh toán</label>
                <span class="text-gray-800">{{ $orders->paymentMethod->name }}</span>
            </div>
            {{-- --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Trạng thái đơn hàng</label>
                <span class="text-gray-800">{{ $orders->orderStatus->name }}</span>
            </div>
            {{-- --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Lí do hủy bỏ</label>
                <span class="text-gray-800">
                    @isset( $orders->canceled_reason)
                        {{  $orders->canceled_reason }}
                    @else
                    @endisset
                </span>
            </div>
            {{-- --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Thời gian hủy bỏ</label>
                <span class="text-gray-800">{{ $orders->canceled_at }}</span>
            </div>
            {{--  --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Thời gian đặt hàng</label>
                <span class="text-gray-800">{{ $orders->created_at }}</span>
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-4">
            <a href="" class="button-dark">Hủy đơn hàng</a>
            <a href="{{ route('admin.orders.index') }}" class="button-green">Quay lại</a>
        </div>
    </div>
@endsection
