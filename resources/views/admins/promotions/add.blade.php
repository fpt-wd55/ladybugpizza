@extends('layouts.admin')
@section('title', 'Mã giảm giá | Thêm mới')

@section('content')
    {{ Breadcrumbs::render('admin.promotions.create') }}
    <div class="relative mt-5 overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="mx-auto p-4">
            <h3 class="mb-4 text-lg font-bold text-gray-900">Thêm mã giảm giá</h3>
            <form action="{{ route('admin.promotions.store') }}" class="w-full" enctype="multipart/form-data"
                  method="post">
                @csrf
                <div class="mb-4 grid gap-4 sm:grid-cols-3">
                    <div>
                        <label class="label-md" for="name">Tên mã giảm giá <span class="text-red-500">*</span></label>
                        <input class="input" name="name" placeholder="VD: Pizza yêu thích giảm 10%" type="text"
                               value="{{ old('name') }}"/>
                        @error('name')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div>
                        <label class="label-md" for="points">Điểm</label>
                        <input class="input" name="points" placeholder="VD: 50" type="number"
                               value="{{ old('points') }}" min="0"/>
                        @error('points')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div>
                        <label class="label-md" for="discount_type">Loại giảm giá <span
                                class="text-red-500">*</span></label>
                        <select class="select w-full" id="discount_type" name="discount_type">
                            <option value="">Chọn</option>
                            <option {{ old('discount_type') == '1' ? 'selected' : '' }} value="1">Giảm giá theo %
                            </option>
                            <option {{ old('discount_type') == '2' ? 'selected' : '' }} value="2">Giảm giá theo số
                                tiền
                            </option>
                        </select>
                        @error('discount_type')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 grid gap-4 sm:grid-cols-3">
                    <div>
                        <label class="label-md" for="discount_value">Giá trị giảm giá <span
                                class="text-red-500">*</span></label>
                        <input class="input" name="discount_value" placeholder="VD: 10" type="number" min="0"
                               value="{{ old('discount_value') }}"/>
                        @error('discount_value')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div>
                        <label class="label-md" for="start_date">Ngày bắt đầu <span
                                class="text-red-500">*</span></label>
                        <input class="input" name="start_date" type="datetime-local" value="{{ old('start_date') }}"/>
                        @error('start_date')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div>
                        <label class="label-md" for="end_date">Ngày kết thúc <span class="text-red-500">*</span></label>
                        <input class="input" name="end_date" type="datetime-local" value="{{ old('end_date') }}"/>
                        @error('end_date')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 grid gap-4 sm:grid-cols-3">
                    <div>
                        <label class="label-md" for="quantity">Số lượng <span class="text-red-500">*</span></label>
                        <input class="input" name="quantity" placeholder="VD: 14" type="number" min="0"
                               value="{{ old('quantity') }}"/>
                        @error('quantity')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div>
                        <label class="label-md" for=" min_order_total">Đơn hàng tối thiểu (₫)</label>
                        <input class="input" name="min_order_total" placeholder="VD: 100000" type="number" min="0"
                               value="{{ old('min_order_total') }}"/>
                        @error('min_order_total')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div>
                        <label class="label-md" for="max_discount">Giảm tối đa (₫)</label>
                        <input class="input" name="max_discount" placeholder="VD: 50000" type="number" min="0"
                               value="{{ old('max_discount') }}"/>
                        @error('max_discount')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="mb-4 block text-sm font-medium text-gray-900" for="status">Trạng
                            thái</label>
                        <label class="inline-flex cursor-pointer items-center">
                            <input {{ old('status') ? 'checked' : '' }} class="peer sr-only" name="status"
                                   type="checkbox" value="1">
                            <div
                                class="peer relative h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-0 rtl:peer-checked:after:-translate-x-full">
                            </div>
                            <span class="ms-3 text-sm font-medium text-gray-900">Hoạt
                                động</span>
                        </label>
                        @error('status')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div>
                        <label class="label-md" for="is_global">Đối tượng áp dụng <span
                                class="text-red-500">*</span></label>
                        <select class="select" name="is_global">
                            <option value="">Chọn</option>
                            <option
                                {{ old('is_global', $promotion->is_global ?? '') == '1' ? 'selected' : '' }} value="1">
                                Tất cả
                            </option>
                            <option
                                {{ old('rank_id', $promotion->rank_id ?? '') == '1' ? 'selected' : '' }} value="2|1">
                                Rank
                                đồng
                            </option>
                            <option
                                {{ old('rank_id', $promotion->rank_id ?? '') == '2' ? 'selected' : '' }} value="2|2">
                                Rank
                                bạc
                            </option>
                            <option
                                {{ old('rank_id', $promotion->rank_id ?? '') == '3' ? 'selected' : '' }} value="2|3">
                                Rank
                                vàng
                            </option>
                            <option
                                {{ old('rank_id', $promotion->rank_id ?? '') == '4' ? 'selected' : '' }} value="2|4">
                                Rank
                                kim cương
                            </option>
                        </select>
                        @error('is_global')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
                <div
                    class="mt-14 flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                    <a class="button-gray" href="{{ route('admin.promotions.index') }}">Quay lại</a>
                    <button class="button-blue" type="submit">Thêm mã giảm giá</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Ẩn số tiền tối đa khi loại giảm giá là giá trị tiền --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const discountType = document.getElementById('discount_type');
            const maxDiscountInput = document.querySelector('input[name="max_discount"]');

            const toggleMaxDiscount = () => {
                if (discountType.value === '2') {
                    maxDiscountInput.closest('div').style.display = 'none'; // Ẩn ô input
                } else {
                    maxDiscountInput.closest('div').style.display = ''; // Hiện ô input
                }
            };

            // Lắng nghe sự kiện thay đổi dropdown
            discountType.addEventListener('change', toggleMaxDiscount);

            // Gọi hàm ngay từ đầu để kiểm tra trạng thái ban đầu
            toggleMaxDiscount();
        });
    </script>
@endsection
