@extends('layouts.client')

@section('title', 'Thanh toán')

@section('content')
    <div class="min-h-screen">
        <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
            <div class="mb-12 p-4 md:p-8">
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-5">
                    <div class="col-span-3">
                        {{-- Thông tin thanh toán --}}
                        <div class="mb-5 border rounded-md p-5">
                            <p class="mb-4 font-bold">Thông tin thanh toán
                            </p>
                            <div class="mb-4">
                                <p class="mb-2 text-sm font-normal">Họ và tên: </p>
                                <input class="input w-full" name="fullname" type="text"
                                    value="{{ old('fullname') ?? Auth::user()->fullname }}" placeholder="Họ và tên">
                                @error('fullname')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4 grid grid-cols-12 items-center gap-4">
                                <div class="col-span-12 lg:col-span-8">
                                    <p class="mb-2 text-sm font-normal">Email:</p>
                                    <input class="input w-full" name="email" type="text"
                                        value="{{ old('email') ?? Auth::user()->email }}" placeholder="Email">
                                    @error('email')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-span-12 lg:col-span-4">
                                    <p class="mb-2 text-sm font-normal">Số điện thoại:</p>
                                    <input class="input w-full" name="phone" type="text"
                                        value="{{ old('phone') ?? Auth::user()->phone }}" placeholder="Số điện thoại">
                                    @error('phone')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Địa chỉ --}}
                        <div class="mb-5 border rounded-md p-5">
                            <p class="mb-4 font-bold">Địa chỉ nhận hàng</p>
                            <div class="mb-4">
                                <select class="input" id="old_address" name="old_address">
                                    <option value="-1" {{ old('old_address') ? 'selected' : '' }}>Chọn địa chỉ </option>
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
                                <input class="input w-full" type="text" name="detail_address"
                                    placeholder="Địa chỉ chi tiết">
                                @error('detail_address')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4 grid grid-cols-12 items-center gap-4">
                                <div class="col-span-12 lg:col-span-4">
                                    <p class="mb-2 text-sm font-normal">Tỉnh/Thành phố:</p>
                                    <input class="input w-full" type="text" name="province" placeholder="Tỉnh/Thành phố">
                                    @error('province')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-span-6 lg:col-span-4">
                                    <p class="mb-2 text-sm font-normal">Quận/Huyện:</p>
                                    <input class="input w-full" type="text" name="district" placeholder="Quận/Huyện">
                                    @error('district')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-span-6 lg:col-span-4">
                                    <p class="mb-2 text-sm font-normal">Phường/Xã:</p>
                                    <input class="input w-full" type="text" name="ward" placeholder="Phường/Xã">
                                    @error('ward')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Thanh toán --}}
                        <div class="mb-5 border rounded-md p-5">
                            <p class="mb-4 font-bold">Phương thức thanh toán</p>
                            <div class="flex items-center justify-between">
                                <div class="mb-4 flex items-center">
                                    <input class="input-radio me-2" id="default-radio-1" name="default-radio" type="radio"
                                        value="">
                                    <label class="text-sm font-normal" for="default-radio-1">Thanh toán khi nhận
                                        hàng</label>
                                </div>
                                @svg('tabler-truck', 'icon-lg text-gray-700')
                            </div>
                            <hr class="mb-4">
                            <div class="flex items-center justify-between">
                                <div class="mb-4 flex items-center">
                                    <input class="input-radio me-2" id="default-radio-1" name="default-radio" type="radio"
                                        value="">
                                    <label class="text-sm font-normal" for="default-radio-1">Ví MoMo</label>
                                </div>
                                @svg('tabler-credit-card', 'icon-lg text-gray-700')
                            </div>
                            <hr class="mb-4">
                            <div class="flex items-center gap-2 text-sm">
                                <span>Bạn cần trợ giúp?</span>
                                <a class="link-md" href="{{ route('client.contact') }}">Liên hệ với chúng tôi</a>
                            </div>
                        </div>
                        {{-- Sản phẩm --}}
                        <div class="mb-5 border rounded-md p-5">
                            <p class="mb-4 font-bold">Danh sách sản phẩm</p>
                            <div class="grid grid-cols-1 gap-4">
                                <!-- component -->
                                @foreach ($cartItems as $item)
                                    <div class="flex justify-start items-start">
                                        <img loading="lazy"
                                            src="{{ asset('storage/uploads/products/' . $item->product->image) }}"
                                            onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'"
                                            class="w-16 h-16 object-cover bg-slate-300 rounded-md">
                                        <div class="w-full flex flex-col justify-between ms-2">
                                            <div class="flex justify-between item-center mb-1">
                                                <p class="font-bold">{{ $item->product->name }}<span
                                                        class="text-sm font-normal ps-2">
                                                        x{{ $item->quantity }}
                                                    </span></p>
                                                <p class="font-bold">{{ number_format($item->price) }}₫</p>
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
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="mb-5 border rounded-md p-5">
                            <p class="mb-4 font-bold">Đơn hàng của bạn</p>
                            <div>
                                <div class="flex items-center gap-2 mb-4">
                                    <input class="input" placeholder="Mã giảm giá" type="text" name="evaluation">
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
                        <div class="flex justify-between items-center">
                            <a href="{{ route('client.contact') }}"
                                class="text-sm font-medium text-gray-800 hover:underline">Giỏ
                                hàng</a>
                            <button class="button-red">Thanh toán</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
