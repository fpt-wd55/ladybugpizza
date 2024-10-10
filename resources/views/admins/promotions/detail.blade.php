@extends('layouts.admin')
@section('title', 'Chi tiết mã giảm giá')

@section('content')
    <div class="mx-10">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Chi tiết mã giảm giá</h2>
        <div class="space-y-4">
            {{-- Code --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Tên mã giảm giá:</label>
                <span class="text-gray-800">{{ $promotion->code }}</span>
            </div>

            {{-- Description --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Mô tả:</label>
                <span class="text-gray-800">{{ $promotion->description }}</span>
            </div>

            {{-- Discount Type --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Loại giảm giá:</label>
                <span class="text-gray-800">
                    @if ($promotion->discount_type == '1')
                        Giảm theo %
                    @elseif ($promotion->discount_type == '2')
                        Giảm theo số tiền
                    @endif
                </span>
            </div>

            {{-- Discount Value --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Giá trị giảm giá:</label>
                <span class="text-gray-800">{{ $promotion->discount_value }}</span>
            </div>

            {{-- Start Date --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Ngày bắt đầu:</label>
                <span class="text-gray-800">{{ \Carbon\Carbon::parse($promotion->start_date)->format('d/m/Y H:i') }}</span>
            </div>

            {{-- End Date --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Ngày kết thúc:</label>
                <span class="text-gray-800">{{ \Carbon\Carbon::parse($promotion->end_date)->format('d/m/Y H:i') }}</span>
            </div>

            {{-- Quantity --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Số lượng:</label>
                <span class="text-gray-800">{{ $promotion->quantity }}</span>
            </div>

            {{-- Min Order Total --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Đơn hàng tối thiểu:</label>
                <span class="text-gray-800">{{ $promotion->min_order_total }}</span>
            </div>

            {{-- Max Discount --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Giảm tối đa:</label>
                <span class="text-gray-800">{{ $promotion->max_discount }}</span>
            </div>

            {{-- Is Global --}}
            <div class="flex justify-between bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Đối tượng áp dụng:</label>
                <span class="text-gray-800">{{ $promotion->is_global == '2' ? 'Tất cả' : 'Thành viên' }}</span>
            </div>

            {{-- Status --}}
            <div class="flex justify-between items-center bg-blue-50 p-4 rounded-lg shadow-sm">
                <label class="font-semibold">Hoạt động:</label>
                <div class="flex items-center">
                    <input type="checkbox" id="status-toggle" name="status" class="sr-only peer"
                        {{ $promotion->status == 1 ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-300 rounded-full peer-checked:bg-blue-500 transition-all"></div>
                    <div
                        class="w-5 h-5 bg-white rounded-full shadow-md absolute transform peer-checked:translate-x-5 transition-all"></div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-4">
            <a href="{{ route('admin.promotions.index') }}" class="button-green">Quay lại</a>
            <a href="{{ route('admin.promotions.edit', $promotion->id) }}" class="button-blue">Sửa</a>
        </div>
    </div>
@endsection
