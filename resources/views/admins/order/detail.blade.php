@extends('layouts.admin')
@section('title', 'Chi tiết hóa đơn')

@section('content')
    <div class="mx-10">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Chi tiết hóa đơn</h2>
        <div class="space-y-4">
            {{--  --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Tên người dùng</label>
                <span class="text-gray-800">{{ $orders->user->fullname }}</span>
            </div>
            {{--  --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Mã giảm giá:</label>
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
                <label class="font-semibold w-20">Ghi chú</label>
                <span class="text-gray-800">{{ $orders->notes }}</span>
            </div>
            {{-- --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Hình thức thanh toán</label>
                <span class="text-gray-800">{{ $orders->paymentMethod->name }}</span>
            </div>
            {{-- --}}
            {{-- <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Giảm tối đa:</label>
                <span class="text-gray-800">{{  number_format($promotion->max_discount ) }}</span>
            </div> --}}

            {{-- Is Global --}}
            {{-- <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Đối tượng áp dụng:</label>
                <span class="text-gray-800">{{ $promotion->is_global == '2' ? 'Tất cả' : 'Thành viên' }}</span>
            </div> --}}

            {{-- Status --}}
            {{-- <div class="flex justify-between items-center bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Hoạt động:</label>
                <div class="flex items-center">
                    <input type="checkbox" id="status-toggle" name="status" class="sr-only peer"
                        @checked($promotion->status == 1)>
                    <div class="w-11 h-6 bg-gray-300 rounded-full peer-checked:bg-blue-600 transition-all"></div>
                    <div
                        class="w-5 h-5 bg-white rounded-full shadow-md absolute transform peer-checked:translate-x-5 transition-all">
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="mt-8 flex justify-end gap-4">
            <a href="">Hủy đơn hàng</a>
            <a href="" class="button-default text-gray-800">Xem hóa đơn</a>
            <a href="{{ route('admin.orders.index') }}" class="button-green">Quay lại</a>
        </div>
    </div>
@endsection
