@extends('layouts.client')

@section('title', 'Thanh toán')

@section('content')
    <form action="" method="post">
        @csrf
        @method('POST')
        <div class="min-h-screen">
            <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
                <div class="mb-12 p-4 md:p-8">
                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-5">
                        <div class="col-span-3">
                            {{-- Thông tin thanh toán --}}
                            <div class="mb-5 rounded-md border p-5">
                                <p class="mb-4 font-semibold uppercase">Thông tin thanh toán
                                </p>
                                <div class="mb-4">
                                    <p class="mb-2 text-sm font-normal">Họ và tên: </p>
                                    <input class="input w-full" name="fullname" placeholder="Họ và tên" type="text" value="{{ old('fullname') ?? Auth::user()->fullname }}">
                                    @error('fullname')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4 grid grid-cols-12 items-center gap-4">
                                    <div class="col-span-12 lg:col-span-8">
                                        <p class="mb-2 text-sm font-normal">Email:</p>
                                        <input class="input w-full" name="email" placeholder="Email" type="text" value="{{ old('email') ?? Auth::user()->email }}">
                                        @error('email')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-span-12 lg:col-span-4">
                                        <p class="mb-2 text-sm font-normal">Số điện thoại:</p>
                                        <input class="input w-full" name="phone" placeholder="Số điện thoại" type="text" value="{{ old('phone') ?? Auth::user()->phone }}">
                                        @error('phone')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Địa chỉ --}}
                            <div class="mb-5 rounded-md border p-5">
                                <p class="mb-4 font-semibold uppercase">Địa chỉ nhận hàng</p>
                                <div class="mb-4">
                                    <select class="input" id="old_address" name="old_address">
                                        <option {{ old('old_address') ? 'selected' : '' }} value="-1">Chọn địa chỉ </option>
                                        @foreach ($addresses as $address)
                                            <option value="{{ $address->id }}">{{ $address->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('old_address')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <p class="mb-2 text-sm font-normal">Địa chỉ chi tiết:
                                    </p>
                                    <input class="input w-full" name="detail_address" placeholder="Địa chỉ chi tiết" type="text">
                                    @error('detail_address')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4 grid grid-cols-12 items-center gap-4">
                                    <div class="col-span-12 lg:col-span-4">
                                        <p class="mb-2 text-sm font-normal">Tỉnh/Thành phố:</p>
                                        <input class="input w-full" name="province" placeholder="Tỉnh/Thành phố" type="text">
                                        @error('province')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-span-6 lg:col-span-4">
                                        <p class="mb-2 text-sm font-normal">Quận/Huyện:</p>
                                        <input class="input w-full" name="district" placeholder="Quận/Huyện" type="text">
                                        @error('district')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-span-6 lg:col-span-4">
                                        <p class="mb-2 text-sm font-normal">Phường/Xã:</p>
                                        <input class="input w-full" name="ward" placeholder="Phường/Xã" type="text">
                                        @error('ward')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Sản phẩm --}}
                            <div class="mb-5 rounded-md border p-5">
                                <p class="mb-4 font-semibold uppercase">Danh sách sản phẩm</p>
                                <div class="grid grid-cols-1 gap-4">
                                    <!-- component -->
                                    @foreach ($cartItems as $item)
                                        <div class="flex items-start justify-start">
                                            <img class="h-16 w-16 rounded-md bg-slate-300 object-cover" loading="lazy" onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'" src="{{ asset('storage/uploads/products/' . $item->product->image) }}">
                                            <div class="ms-2 flex w-full flex-col justify-between">
                                                <div class="item-center mb-1 flex justify-between">
                                                    <p class="font-semibold text-sm">{{ $item->product->name }}</p>
                                                </div>
                                                <div class="text-sm">
                                                    <p class="line-clamp-1">
                                                        {{ implode(', ', $item->attributes->pluck('attribute_value.value')->toArray()) }}
                                                    </p>
                                                    <p class="line-clamp-1">
                                                        @if (isset($item->toppings) && count($item->toppings) > 0)
                                                            Topping:
                                                            {{ implode(', ', $item->toppings->pluck('topping.name')->toArray()) }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="ps-2 text-sm font-normal">
                                                    <span>x</span>
                                                    <span>{{ $item->quantity }}</span>
                                                </p>
                                                <p class="font-medium text-sm">{{ number_format($item->price) }}₫</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="mb-5 rounded-md border p-5">
                                <p class="mb-4 font-semibold uppercase">Đơn hàng của bạn</p>
                                <div>
                                    <div class="mb-4 flex items-center gap-2">
                                        <input class="input" name="evaluation" placeholder="Mã giảm giá" type="text">
                                        <button class="button-red w-32" type="button">Sử dụng</button>
                                    </div>
                                    @error('evaluation')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <hr class="mb-4">
                                <div>
                                    <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                                        <p>Tạm tính</p>
                                        <p class="font-medium">150,000₫</p>
                                    </div>
                                    <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                                        <p>Phí vận chuyển</p>
                                        <p class="font-medium">150,000₫</p>
                                    </div>
                                    <div class="mb-4 flex items-center justify-between gap-32 text-sm">
                                        <p>Giảm giá</p>
                                        <p class="font-medium">150,000₫</p>
                                    </div>
                                    <hr class="mb-4">
                                    <div class="mb-4 flex items-center justify-between gap-32">
                                        <p class="text-sm">Tổng tiền</p>
                                        <p class="font-medium">150,000₫</p>
                                    </div>
                                </div>
                            </div>
                            {{-- Thanh toán --}}
                            <div class="mb-5 rounded-md border p-5">
                                <p class="mb-4 font-semibold uppercase">Phương thức thanh toán</p>
                                <div class="flex items-center justify-between">
                                    <div class="mb-4 flex items-center">
                                        <input class="input-radio me-2" id="cod" name="payment-methods" type="radio" value="cod">
                                        <label class="text-sm font-normal" for="cod">Thanh toán khi nhận
                                            hàng</label>
                                    </div>
                                    @svg('tabler-truck', 'icon-lg text-gray-700')
                                </div>
                                <hr class="mb-4">
                                <div class="flex items-center justify-between">
                                    <div class="mb-4 flex items-center">
                                        <input class="input-radio me-2" id="momo" name="payment-methods" type="radio" value="momo">
                                        <label class="text-sm font-normal" for="momo">Ví MoMo</label>
                                    </div>
                                    @svg('tabler-credit-card', 'icon-lg text-gray-700')
                                </div>
                                <hr class="mb-4">
                                <div class="flex items-center gap-2 text-sm">
                                    <span>Bạn cần trợ giúp?</span>
                                    <a class="link-md" href="{{ route('client.contact') }}">Liên hệ với chúng tôi</a>
                                </div>
                            </div>
                            <div class="flex items-center justify-end">
                                <button class="button-red" type="submit">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const oldAddress = document.getElementById('old_address');
            const detailAddress = document.querySelector('input[name="detail_address"]');
            const province = document.querySelector('input[name="province"]');
            const district = document.querySelector('input[name="district"]');
            const ward = document.querySelector('input[name="ward"]');

            const addressesData = @json($addresses);

            oldAddress.addEventListener('change', function() {
                const selectedAddress = addressesData.find(address => address.id == this.value);
                const fields = [detailAddress, province, district, ward];

                if (selectedAddress) {
                    detailAddress.value = selectedAddress.detail_address || '';
                    province.value = selectedAddress.province || '';
                    district.value = selectedAddress.district || '';
                    ward.value = selectedAddress.ward || '';

                    fields.forEach(field => field.setAttribute('disabled', true));
                } else {
                    fields.forEach(field => {
                        field.value = '';
                        field.removeAttribute('disabled');
                    });
                }
            });
        });
    </script>
@endsection
