@extends('layouts.admin')
@section('title', 'Thêm mới mã giảm giá')

@section('content')
    <div class="container">
        <form action="{{ route('admin.promotions.store') }}" class="w-full" method="post" enctype="multipart/form-data">
            @csrf
            <div class="w-full mb-5 grid grid-cols-3 gap-2">
                {{-- code --}}
                <div>
                    <label for="code" class="label-lg">Tên</label>
                    <input type="text" name="code" class="input h-10 mb-2" value="{{ old('code') }}" />
                    @error('code')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- description --}}
                <div>
                    <label for="description" class="label-lg">Mô tả</label>
                    <input type="text" name="description" class="input h-10 mb-2" value="{{ old('description') }}" />
                    @error('description')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- discount_type --}}
                <div>
                    <label for="discount_type" class="label-lg">Loại giảm giá</label>
                    <input type="text" name="discount_type" class="input h-10 mb-2" value="{{ old('discount_type') }}" />
                    @error('discount_type')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- discount_value --}}
                <div>
                    <label for="discount_value" class="label-lg">Giá trị giảm giá</label>
                    <input type="text" name="discount_value" class="input h-10 mb-2"
                        value="{{ old('discount_value') }}" />
                    @error('discount_value')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- start_date --}}
                <div>
                    <label for="start_date" class="label-lg">Ngày bắt đầu</label>
                    <input type="datetime-local" name="start_date" class="input h-10 mb-2"
                        value="{{ old('start_date') }}" />
                    @error('start_date')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- end_date --}}
                <div>
                    <label for="end_date" class="label-lg">Ngày kết thúc</label>
                    <input type="datetime-local" name="end_date" class="input h-10 mb-2" value="{{ old('end_date') }}" />
                    @error('end_date')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- quantity --}}
                <div>
                    <label for="quantity" class="label-lg">Số lượng</label>
                    <input type="number" name="quantity" class="input h-10 mb-2" value="{{ old('quantity') }}" />
                    @error('quantity')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- min_order_total --}}
                <div>
                    <label for=" min_order_total" class="label-lg">Đơn hàng tối thiểu</label>
                    <input type="text" name="min_order_total" class="input h-10 mb-2"
                        value="{{ old('min_order_total') }}" />
                    @error('min_order_total')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                {{-- max_discount --}}
                <div>
                    <label for="max_discount" class="label-lg">Giảm tối đa</label>
                    <input type="text" name="max_discount" class="input h-10 mb-2" value="{{ old('max_discount') }}" />
                    @error('max_discount')
                        <span style="color: red ">{{ $message }}</span>
                    @enderror
                </div>
                
            </div>
            {{-- status --}}
            <div>
                <label for="status" class="label-lg">Trạng thái</label>
                <select name="status" class="input h-10 mb-2">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Không hoạt động
                    </option>
                </select>
                @error('status')
                    <span style="color: red ">{{ $message }}</span>
                @enderror
            </div>
            {{-- is_global --}}
            <div>
                <label for="is_global" class="label-lg">Áp dụng toàn cầu</label>
                <input type="checkbox" name="is_global" class="input-checkbox" value="1"
                    {{ old('is_global') ? 'checked' : '' }} />
                @error('is_global')
                    <span style="color: red ">{{ $message }}</span>
                @enderror
            </div>
            <div
                class="mb-4 flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <button class="button-blue" type="submit">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection
