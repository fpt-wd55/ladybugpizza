@extends('layouts.admin')
@section('title', 'Chi tiết mã giảm giá')

@section('content')
    <div class="container">
        <div class="grid grid-cols-2 gap-4">
            {{-- Code --}}
            <div class="mb-4">
                <label class="label-lg">Mã giảm giá:</label>
                <span class="text-md text-gray-500">{{ $promotion->code }}</span>
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="label-lg">Mô tả:</label>
                <span class="text-md text-gray-500">{{ $promotion->description }}</span>
            </div>

            {{-- Discount Type --}}
            <div class="mb-4">
                <label class="label-lg">Loại giảm giá:</label>
                <span class="text-md text-gray-500">{{ $promotion->discount_type }}</span>
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
                <label class="label-lg">Trạng thái:</label>
                <span class="text-md text-gray-500">{{ $promotion->status == '1' ? 'Hoạt động' : 'Không hoạt động' }}</span>
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('admin.promotions.index') }}" class="button-green">Quay lại</a>
            <a href="{{ route('admin.promotions.edit', $promotion->id) }}" class="button-blue">Sửa</a>
        </div>
    </div>
@endsection
