@extends('layouts.client')

@section('title', 'Thanh toán')

@section('content')
    <div class="min-h-screen">
        <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
            <div class="mb-12 p-4 md:p-8">
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-5">
                    <form action="{{ route('post-checkout') }}" method="post" class="col-span-3" id="form-checkout">
                        @csrf
                        {{-- Thông tin thanh toán --}}
                        <div class="mb-5 border rounded-md p-5">
                            <p class="mb-4 font-bold">Thông tin thanh toán
                            </p>
                            <div class="mb-4">
                                <p class="mb-2 text-sm font-normal">Họ và tên: </p>
                                <input class="input w-full" name="fullname" type="text"
                                    value="{{ old('fullname') ?? Auth::user()->fullname }}" placeholder="Họ và tên">
                                @error('fullname')
                                    <p class="text-sm text-[#D30A0A] pt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid gap-4 mb-4 md:grid-cols-2">
                                <div>
                                    <p class="mb-2 text-sm font-normal">Email:</p>
                                    <input class="input w-full" name="email" type="text"
                                        value="{{ old('email') ?? Auth::user()->email }}" placeholder="Email">
                                    @error('email')
                                        <p class="text-sm text-[#D30A0A] pt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-normal">Số điện thoại:</p>
                                    <input class="input w-full" name="phone" type="text"
                                        value="{{ old('phone') ?? Auth::user()->phone }}" placeholder="Số điện thoại">
                                    @error('phone')
                                        <p class="text-sm text-[#D30A0A] pt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Địa chỉ --}}
                        <div class="mb-5 border rounded-md p-5">
                            <p class="mb-4 font-bold">Địa chỉ nhận hàng</p>
                            <div class="mb-4">
                                <select class="input" id="old_address" name="old_address">
                                    <option value="-1" {{ old('old_address') ? 'selected' : '' }}>Chọn địa chỉ
                                    </option>
                                    @foreach ($addresses as $address)
                                        <option value="{{ $address->id }}">{{ $address->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <p class="mb-2 text-sm font-normal">Địa chỉ chi tiết:
                                </p>
                                <input class="input w-full" type="text" name="detail_address"
                                    value="{{ old('detail_address') }}" placeholder="Địa chỉ chi tiết">
                                @error('detail_address')
                                    <p class="text-sm text-[#D30A0A] pt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid gap-4 mb-4 md:grid-cols-2 lg:grid-cols-3">
                                <div>
                                    <p class="mb-2 text-sm font-normal">Tỉnh/Thành phố:</p>
                                    <input class="input w-full" type="text" name="province"
                                        value="{{ old('province') }}" placeholder="Tỉnh/Thành phố">
                                    @error('province')
                                        <p class="text-sm text-[#D30A0A] pt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-normal">Quận/Huyện:</p>
                                    <input class="input w-full" type="text" name="district"
                                        value="{{ old('district') }}" placeholder="Quận/Huyện">
                                    @error('district')
                                        <p class="text-sm text-[#D30A0A] pt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-normal">Phường/Xã:</p>
                                    <input class="input w-full" type="text" name="ward" value="{{ old('ward') }}"
                                        placeholder="Phường/Xã">
                                    @error('ward')
                                        <p class="text-sm text-[#D30A0A] pt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <input id="remember_address" type="checkbox" name="remember_address" value="1"
                                    {{ old('remember_address') == 1 ? 'checked' : '' }}
                                    class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-0">
                                <label for="remember_address" class="ms-2 text-sm">Lưu lại thông
                                    tin này cho lần sau</label>
                            </div>
                        </div>
                        {{-- Thanh toán --}}
                        <div class="mb-5 border rounded-md p-5">
                            <p class="mb-2 font-bold">Phương thức thanh toán</p>
                            @error('payment_method_id')
                                <p class="text-sm text-[#D30A0A] mb-2">{{ $message }}</p>
                            @enderror
                            @foreach ($paymentMethods as $method)
                                <div class="flex items-center justify-between">
                                    <div class="mb-4 flex items-center">
                                        <input class="input-radio me-2" id="payment_method_id_{{ $method->id }}"
                                            {{ old('payment_method_id') == $method->id ? 'checked' : '' }}
                                            name="payment_method_id" type="radio" value="{{ $method->id }}">
                                        <label class="text-sm font-normal"
                                            for="payment_method_id_{{ $method->id }}">{{ $method->name }}</label>
                                    </div>
                                    @svg('tabler-truck', 'icon-lg text-gray-700')
                                </div>
                                <hr class="mb-4">
                            @endforeach
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
                    </form>
                    <div class="col-span-2">
                        @livewire('apply-promotion')
                        
                        <div class="flex justify-between items-center">
                            <a href="{{ route('client.contact') }}"
                                class="text-sm font-medium text-gray-800 hover:underline">Giỏ
                                hàng</a>
                            <button class="button-red" id="btn-checkout">Thanh toán</button>
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
            const rememberAddress = document.getElementById('remember_address');

            const addressesData = @json($addresses);

            oldAddress.addEventListener('change', function() {
                const selectedAddress = addressesData.find(address => address.id == this.value);
                const fields = [detailAddress, province, district, ward, rememberAddress];

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

        const btnCheckout = document.getElementById('btn-checkout');
        btnCheckout.addEventListener('click', function(e) {
            e.preventDefault();
            const formCheckout = document.getElementById('form-checkout');
            formCheckout.submit();
        });
    </script>
@endsection
