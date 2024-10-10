@extends('layouts.admin')
@section('title', 'Chi tiết mã giảm giá')

@section('content')
    <div class="container">
        {{-- Code --}}
        <div class="mb-10 gap-2">
            <label class="text-3xl">Tên mã giảm giá: </label>
            <span class="text-3xl text-gray-500">{{ $promotion->code }}</span>
        </div>
        <div class="grid grid-cols-3 gap-4">
            {{-- Description --}}
            <div class="mb-4">
                <label class="label-lg">Mô tả:</label>
                <span class="text-md text-gray-500">{{ $promotion->description }}</span>
            </div>
            {{-- Discount Type --}}
            <div class="mb-4">
                <label class="label-lg">Loại giảm giá:</label>
                <span class="text-md text-gray-500">
                    @if ($promotion->discount_type == '1')
                        Giảm theo %
                    @elseif ($promotion->discount_type == '2')
                        Giảm theo số tiền
                    @endif
                </span>
            </div>
            {{-- Discount Value --}}
            <div class="mb-4">
                <label class="label-lg">Giá trị giảm giá:</label>
                <span class="text-md text-gray-500">{{ $promotion->discount_value }}</span>
            </div>
            {{-- Start Date --}}
            <div class="mb-4">
                <label class="label-lg">Ngày bắt đầu:</label>
                <span class="text-md text-gray-500">{{ \Carbon\Carbon::parse($promotion->start_date)->format('d/m/Y H:i') }}</span>
            </div>
            {{-- End Date --}}
            <div class="mb-4">
                <label class="label-lg">Ngày kết thúc:</label>
                <span class="text-md text-gray-500">{{ \Carbon\Carbon::parse($promotion->end_date)->format('d/m/Y H:i') }}</span>
            </div>
            {{-- Quantity --}}
            <div class="mb-4">
                <label class="label-lg">Số lượng:</label>
                <span class="text-md text-gray-500">{{ $promotion->quantity }}</span>
            </div>
            {{-- Min Order Total --}}
            <div class="mb-4">
                <label class="label-lg">Đơn hàng tối thiểu:</label>
                <span class="text-md text-gray-500">{{ $promotion->min_order_total }}</span>
            </div>
            {{-- Max Discount --}}
            <div class="mb-4">
                <label class="label-lg">Giảm tối đa:</label>
                <span class="text-md text-gray-500">{{ $promotion->max_discount }}</span>
            </div>
            {{-- Is Global --}}
            <div class="mb-4">
                <label class="label-lg">Đối tượng áp dụng:</label>
                <span class="text-md text-gray-500">
                    {{ $promotion->is_global == '2' ? 'Tất cả' : 'Thành viên' }}
                </span>
            </div>
            {{-- Status --}}
            <div class="mb-4">
                <label class="label-lg">Hoạt động:</label>
                <div class="flex items-center">
                    <input type="checkbox" id="status-toggle" name="status" class="sr-only peer"
                    {{ $promotion->status == 1 ? 'checked' : '' }} value="1">
                    <div class="w-11 h-6 bg-gray-300 rounded-full peer-checked:bg-blue-500 transition-all"></div>
                    <div class="w-5 h-5 bg-white rounded-full shadow-md absolute transform peer-checked:translate-x-5 transition-all"></div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('admin.promotions.index') }}" class="button-green">Quay lại</a>
            <a href="{{ route('admin.promotions.edit', $promotion->id) }}" class="button-blue">Sửa</a>
        </div>
    </div>
@endsection
