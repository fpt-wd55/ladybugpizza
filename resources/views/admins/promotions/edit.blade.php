@extends('layouts.admin')
@section('title', 'Sửa mã giảm giá')

@section('content')
    {{ Breadcrumbs::render('admin.promotions.edit', $editPromotion) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="p-4 mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 ">Cập nhật mã giảm giá</h3>
            <form action="{{ route('admin.promotions.update', $editPromotion->id) }}" class="w-full" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <label for="name" class="label-md">Tên mã giảm giá <span class="text-red-500">*</span></label>
                        <input type="text" name="name" class="input" value="{{ $editPromotion->name }}"
                            placeholder="VD: Pizza yêu thích giảm 10%" />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="points" class="label-md">Điểm</span></label>
                        <input type="number" name="points" class="input" value="{{ $editPromotion->points }}"
                            placeholder="VD: 50" />
                        @error('points')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="discount_type" class="label-md">Loại giảm giá <span
                                class="text-red-500">*</span></label>
                        <select class="w-full select" name="discount_type" id="discount_type">
                            <option value="">Chọn</option>
                            <option value="1"
                                {{ old('discount_type', $editPromotion->discount_type) == '1' ? 'selected' : '' }}>Giảm giá
                                theo
                                %
                            </option>
                            <option value="2"
                                {{ old('discount_type', $editPromotion->discount_type) == '2' ? 'selected' : '' }}>Giảm giá
                                theo
                                số
                                tiền</option>
                        </select>
                        @error('discount_type')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <label for="discount_value" class="label-md">Giá trị giảm giá <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="discount_value" class="input" placeholder="VD: 10"
                            value="{{ $editPromotion->discount_value }}" />
                        @error('discount_value')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="start_date" class="label-md">Ngày bắt đầu <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="start_date" class="input"
                            value="{{ $editPromotion->start_date }}" />
                        @error('start_date')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="end_date" class="label-md">Ngày kết thúc <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="end_date" class="input"
                            value="{{ $editPromotion->end_date }}" />
                        @error('end_date')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <label for="quantity" class="label-md">Số lượng <span class="text-red-500">*</span></label>
                        <input type="number" name="quantity" class="input" value="{{ $editPromotion->quantity }}"
                            placeholder="VD: 14" />
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for=" min_order_total" class="label-md">Đơn hàng tối thiểu (₫)</label>
                        <input type="text" name="min_order_total" class="input" placeholder="VD: 100000"
                            value="{{ $editPromotion->min_order_total }}" />
                        @error('min_order_total')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="max_discount" class="label-md">Giảm tối đa (₫)</label>
                        <input type="text" name="max_discount" class="input" placeholder="VD: 50000"
                            value="{{ $editPromotion->max_discount }}" />
                        @error('max_discount')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="mb-4 block text-sm font-medium text-gray-900" for="status">Trạng
                            thái</label>
                        <label class="inline-flex cursor-pointer items-center">
                            <input type="hidden" name="status" value="2">
                            <input {{ old('status', $editPromotion->status) == 1 ? 'checked' : '' }} class="peer sr-only"
                                name="status" type="checkbox" value="1">
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
                        <label for="code" class="label-md">Mã giảm giá <span class="text-red-500">*</span></label>
                        <input type="text" name="code" class="input" placeholder="VD: I4o492Pohw"
                            value="{{ $editPromotion->code }}" />
                        @error('code')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="is_global" class="label-md">Đối tượng áp dụng <span
                                class="text-red-500">*</span></label>
                        <select name="is_global" class="select">
                            <option value="">Chọn</option>
                            <option value="1"
                                {{ old('is_global', $editPromotion->is_global) == '1' ? 'selected' : '' }}>
                                Tất cả</option>
                            <option value="2|1" {{ old('rank_id', $editPromotion->rank_id) == '1' ? 'selected' : '' }}>
                                Rank đồng</option>
                            <option value="2|2" {{ old('rank_id', $editPromotion->rank_id) == '2' ? 'selected' : '' }}>
                                Rank bạc</option>
                            <option value="2|3" {{ old('rank_id', $editPromotion->rank_id) == '3' ? 'selected' : '' }}>
                                Rank vàng</option>
                            <option value="2|4" {{ old('rank_id', $editPromotion->rank_id) == '4' ? 'selected' : '' }}>
                                Rank kim cương</option>
                        </select>
                        @error('is_global')
                            <p class="mt-2 text-sm text-red-600 ">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>
                <div
                    class="mt-14 flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                    <a href="{{ route('admin.promotions.index') }}" class="button-gray">Quay lại</a>
                    <button class="button-blue" type="submit">Cập nhập mã giảm giá</button>
                </div>
            </form>
        </div>
    </div>
@endsection
