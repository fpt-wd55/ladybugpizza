@extends('layouts.client')

@section('title', 'Thanh toán')

@section('content')
    @if ($cartItems->count() == 0)
    <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
        <p class="title">THANH TOÁN</p>
        <div class="card min-h-96 flex flex-col items-center justify-center gap-8 p-4 text-gray-500 md:p-8">
            @svg('tabler-shopping-bag-exclamation', 'icon-xl')
            <p class="text text-center">Giỏ hàng của bạn đang trống</p>
            <a class="button-red" href="{{ route('client.product.menu') }}">Thực đơn</a>
        </div>
    </div>
    @else
        <form action="{{ route('post-checkout') }}" class="col-span-3" id="form-checkout" method="post">
            @csrf
            <div class="min-h-screen">
                <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
                    <div class="mb-12 p-4 md:p-8">
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-5">

                            <div class="col-span-5 lg:col-span-3">
                                {{-- Thông tin thanh toán --}}
                                <div class="mb-5 rounded-md border p-5">
                                    <p class="mb-4 font-bold">Thông tin thanh toán
                                    </p>
                                    <div class="mb-4">
                                        <p class="mb-2 text-sm font-normal">Họ và tên: </p>
                                        <input class="input w-full" name="fullname" placeholder="Họ và tên" type="text" value="{{ old('fullname') ?? Auth::user()->fullname }}">
                                        @error('fullname')
                                            <p class="pt-2 text-sm text-[#D30A0A]">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4 grid gap-4 md:grid-cols-2">
                                        <div>
                                            <p class="mb-2 text-sm font-normal">Email:</p>
                                            <input class="input w-full" name="email" placeholder="Email" type="text" value="{{ old('email') ?? Auth::user()->email }}">
                                            @error('email')
                                                <p class="pt-2 text-sm text-[#D30A0A]">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <p class="mb-2 text-sm font-normal">Số điện thoại:</p>
                                            <input class="input w-full" name="phone" placeholder="Số điện thoại" type="text" value="{{ old('phone') ?? Auth::user()->phone }}">
                                            @error('phone')
                                                <p class="pt-2 text-sm text-[#D30A0A]">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <p class="mb-2 text-sm font-normal">Ghi chú: </p>
                                        <textarea class="text-area" id="notes" name="notes" rows="4"></textarea>
                                        @error('notes')
                                            <p class="pt-2 text-sm text-[#D30A0A]">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Địa chỉ --}}
                                <div class="mb-5 rounded-md border p-5">
                                    <p class="mb-4 font-bold">Địa chỉ nhận hàng</p>
                                    <div class="mb-4">
                                        <select class="input" id="old_address" name="old_address">
                                            <option {{ old('old_address') ? 'selected' : '' }} value="-1">Chọn địa chỉ
                                            </option>
                                            @foreach ($addresses as $address)
                                                <option value="{{ $address->id }}">{{ $address->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <p class="mb-2 text-sm font-normal">Địa chỉ chi tiết:
                                        </p>
                                        <input class="input w-full" name="detail_address" placeholder="Địa chỉ chi tiết" type="text" value="{{ old('detail_address') }}">
                                        @error('detail_address')
                                            <p class="pt-2 text-sm text-[#D30A0A]">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                                        <div>
                                            <p class="mb-2 text-sm font-normal">Tỉnh/Thành phố:</p>
                                            <input class="input w-full" name="province" placeholder="Tỉnh/Thành phố" type="text" value="{{ old('province') }}">
                                            @error('province')
                                                <p class="pt-2 text-sm text-[#D30A0A]">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <p class="mb-2 text-sm font-normal">Quận/Huyện:</p>
                                            <input class="input w-full" name="district" placeholder="Quận/Huyện" type="text" value="{{ old('district') }}">
                                            @error('district')
                                                <p class="pt-2 text-sm text-[#D30A0A]">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <p class="mb-2 text-sm font-normal">Phường/Xã:</p>
                                            <input class="input w-full" name="ward" placeholder="Phường/Xã" type="text" value="{{ old('ward') }}">
                                            @error('ward')
                                                <p class="pt-2 text-sm text-[#D30A0A]">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Sản phẩm --}}
                                <div class="mb-5 rounded-md border p-5">
                                    <p class="mb-4 font-bold">Danh sách sản phẩm</p>
                                    <div class="grid grid-cols-1 gap-4">
                                        <!-- component -->
                                        @foreach ($cartItems as $item)
                                            <div class="flex items-start justify-start">
                                                <img class="h-16 w-16 rounded-md bg-slate-300 object-cover" loading="lazy" onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'" src="{{ asset('storage/uploads/products/' . $item->product->image) }}">
                                                <div class="ms-2 flex w-full flex-col justify-between">
                                                    <div class="item-center mb-1 flex justify-between">
                                                        <p class="text-sm font-semibold">{{ $item->product->name }}<span class="ps-2 text-sm font-normal">
                                                                x{{ $item->quantity }}
                                                            </span></p>
                                                        <p class="font-semibold">{{ number_format($item->price) }}₫</p>
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

                            {{-- Thôn tin đơn hàng - mã giảm giá --}}
                            <div class="col-span-5 lg:col-span-2">
                                @livewire('apply-promotion')
                                {{-- Thanh toán --}}
                                <div class="mb-5 rounded-md border p-5">
                                    <p class="mb-2 font-bold">Phương thức thanh toán</p>
                                    @error('payment_method_id')
                                        <p class="mb-2 text-sm text-[#D30A0A]">{{ $message }}</p>
                                    @enderror
                                    @foreach ($paymentMethods as $method)
                                        <div class="flex items-center justify-between">
                                            <div class="mb-4 flex items-center">
                                                <input {{ old('payment_method_id') == $method->id ? 'checked' : '' }} class="input-radio me-2" id="payment_method_id_{{ $method->id }}" name="payment_method_id" type="radio" value="{{ $method->id }}">
                                                <label class="text-sm font-normal" for="payment_method_id_{{ $method->id }}">{{ $method->name }}</label>
                                            </div>
                                            {{-- neu la momo thi hien thi credict card --}}
                                            @if ($method->id == 1)
                                                @svg('tabler-credit-card', 'icon-lg text-gray-700')
                                            @else
                                                @svg('tabler-truck', 'icon-lg text-gray-700')
                                            @endif
                                        </div>
                                        <hr class="mb-4">
                                    @endforeach
                                    <div class="flex items-center gap-2 text-sm">
                                        <span>Bạn cần trợ giúp?</span>
                                        <a class="link-md" href="{{ route('client.contact') }}">Liên hệ với chúng tôi</a>
                                    </div>
                                </div>
                                <div class="flex items-center justify-end">
                                    <button class="button-red" id="btn-checkout">Thanh toán</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
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
                    console.log(1);
                    province.value = selectedAddress.province || '';
                    district.value = selectedAddress.district || '';
                    ward.value = selectedAddress.ward || '';

                    // add readonly
                    fields.forEach(field => {
                        field.setAttribute('readonly', true);
                    });

                } else {
                    fields.forEach(field => {
                        field.value = '';
                        field.removeAttribute('readonly');
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
