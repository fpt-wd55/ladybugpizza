<div class="mb-5 rounded-md border p-5">
    <p class="mb-4 font-bold">Đơn hàng của bạn</p>
    <div>
        <form method="post" wire:submit="applyPromotion">
            @csrf
            <div class="mb-2 flex items-center gap-2">
                <input class="input" placeholder="Mã giảm giá" type="text" wire:model="promotion_code">
                <button class="button-red w-32" type="submit">
                    <p wire:loading.remove>Sử dụng</p>
                    <p wire:loading>@svg('tabler-loader-2', 'animate-spin icom-md text-white')</p>
                </button>
            </div>
            @error('promotion_code')
                <p class="pb-2 text-sm text-[#D30A0A]">{{ $message }}</p>
            @enderror
            @if (session('promotion_code'))
                <p class="pb-2 text-sm text-[#D30A0A]">{{ session('promotion_code') }}</p>
            @endif
        </form>
    </div>
    <hr class="mb-4">
    <div>
        <div class="mb-4 flex items-center justify-between gap-32 text-sm">
            <p>Tạm tính</p>
            <p class="font-medium">{{ number_format($cart->total) }}₫</p>
        </div>
        <div class="mb-4 flex items-center justify-between gap-32 text-sm">
            <p>Phí vận chuyển</p>
            <p class="font-medium">{{ number_format($shipping_fee) }}₫</p>
        </div>
        <div class="mb-4 flex items-center justify-between gap-32 text-sm">
            <p>Giảm giá</p>
            <p class="font-medium">{{ number_format($discount) }}₫</p>
        </div>
        <hr class="mb-4">
        <div class="mb-4 flex items-center justify-between gap-32">
            <p class="text-sm">Tổng tiền</p>
            <p class="font-medium">
                {{ number_format($cart->total + $shipping_fee - $discount) }}₫</p>
        </div>
    </div>
</div>
