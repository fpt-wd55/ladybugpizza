@extends('layouts.admin')
@section('title', 'Thêm mới mã giảm giá')

@section('content')
    <div class="container">
        <form action="{{ route('admin.promotions.store') }}" class="w-full" method="post" enctype="multipart/form-data">
            @csrf
            <div class="w-full mb-2 grid grid-cols-3 gap-2">
                {{-- code --}}
                <div> 
                    <label for="code" class="label-lg">Tên <span class="text-red-500">*</span></label>
                    <input type="text" name="code" class="input h-10 mb-2" value="{{ old('code') }}" />
                    @error('code')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- description --}}
                <div>
                    <label for="description" class="label-lg">Mô tả <span class="text-red-500">*</span></label>
                    <input type="text" name="description" class="input h-10 mb-2" value="{{ old('description') }}" />
                    @error('description')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- discount_type --}}
                <div>
                    <label for="discount_type" class="label-lg">Loại giảm giá <span class="text-red-500">*</span></label>
                    <select class="w-full h-10 mb-2 select" name="discount_type" id="discount_type">
                        <option value="">Chọn</option>
                        <option value="1" {{ old('discount_type') == '1' ? 'selected' : '' }}>Giảm giá theo %
                        </option>
                        <option value="2" {{ old('discount_type') == '2' ? 'selected' : '' }}>Giảm giá theo số
                            tiền</option>
                    </select>
                    @error('discount_type')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- discount_value --}}
                <div>
                    <label for="discount_value" class="label-lg">Giá trị giảm giá <span class="text-red-500">*</span></label>
                    <input type="text" name="discount_value" class="input h-10 mb-2"
                        value="{{ old('discount_value') }}" />
                    @error('discount_value')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- start_date --}}
                <div>
                    <label for="start_date" class="label-lg">Ngày bắt đầu <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="start_date" class="input h-10 mb-2"
                        value="{{ old('start_date') }}" />
                    @error('start_date')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- end_date --}}
                <div>
                    <label for="end_date" class="label-lg">Ngày kết thúc <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="end_date" class="input h-10 mb-2" value="{{ old('end_date') }}" />
                    @error('end_date')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- quantity --}}
                <div>
                    <label for="quantity" class="label-lg">Số lượng <span class="text-red-500">*</span></label>
                    <input type="number" name="quantity" class="input h-10 mb-2" value="{{ old('quantity') }}" />
                    @error('quantity')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- min_order_total --}}
                <div>
                    <label for=" min_order_total" class="label-lg">Đơn hàng tối thiểu (VNĐ)</label>
                    <input type="text" name="min_order_total" class="input h-10 mb-2"
                        value="{{ old('min_order_total') }}" />
                    @error('min_order_total')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- max_discount --}}
                <div>
                    <label for="max_discount" class="label-lg">Giảm tối đa (VNĐ)</label>
                    <input type="text" name="max_discount" class="input h-10 mb-2" value="{{ old('max_discount') }}" />
                    @error('max_discount')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2">
                {{-- status --}}
                <div>
                    <label for="name" class="block mb-2 text-base font-medium text-gray-900">Hoạt động</label>
                    <div class="flex justify-start">
                        <label for="status-toggle" class="inline-flex relative items-center cursor-pointer">
                            <input type="hidden" name="status" value="2">
                            <input type="checkbox" id="status-toggle" name="status" class="sr-only peer" 
                                   value="1" {{ old('status', $promotion->status ?? 1) == 1 ? 'checked' : '' }}>                            
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                        </label>
                    </div>
                    @error('status')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- is_global --}}
                <div>
                    <label for="is_global" class="label-lg">Đối tượng áp dụng <span class="text-red-500">*</span></label>
                    <select
                        name="is_global"
                        class="mb-2 block w-full text-sm text-gray-500 
                               bg-transparent border-0 border-b-2 border-gray-200 appearance-none 
                               dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option value="">Chọn</option>
                        <option value="2" {{ old('is_global', $promotion->is_global ?? '') == '2' ? 'selected' : '' }}>Tất cả</option>
                        <option value="1" {{ old('is_global', $promotion->is_global ?? '') == '1' ? 'selected' : '' }}>Thành viên</option>                   
                        {{-- <option value="1" {{ old('is_global', $promotion->is_global ?? '') == '1' ? 'selected' : '' }}>Rank bạc</option>                   
                        <option value="1" {{ old('is_global', $promotion->is_global ?? '') == '1' ? 'selected' : '' }}>Rank vàng</option>                   
                        <option value="1" {{ old('is_global', $promotion->is_global ?? '') == '1' ? 'selected' : '' }}>Rank kim cương</option>                    --}}
                    </select>
                    
                    @error('is_global')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                
            </div>
            <div
                class="mt-14 flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <button class="button-blue" type="submit">Thêm</button>
                <a href="{{ route('admin.promotions.index') }}" class="button-green">Quay lại</a>
            </div>
        </form>
    </div>
@endsection
