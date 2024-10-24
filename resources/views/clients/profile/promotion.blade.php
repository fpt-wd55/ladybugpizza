@extends('layouts.client')

@section('title', 'Mã giảm giá')

@section('content')
    <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
        <div class="lg:flex">

            @include('clients.profile.sidebar')

            <div class="card min-h-screen w-full p-4 md:p-8">
                <h3 class="mb-8 font-semibold uppercase">mã giảm giá</h3>
                {{-- tabs --}}
                <div class="mb-4 border-b border-gray-200 text-center text-sm font-medium text-gray-500">
                    <ul class="-mb-px flex flex-wrap">
                        <li class="me-2">
                            <a aria-current="page" class="{{ request('tab') == 'my-code' ? 'border-b-red-600 text-red-600' : '' }} inline-block rounded-t-lg border-b-2 px-4 pb-2" href="{{ route('client.profile.promotion', ['tab' => 'my-code']) }}">Mã
                                {{-- thay số 13 bằng tổng mã giảm giá của tôi --}}
                                giảm giá của tôi (13)</a>
                        </li>
                        <li class="me-2">
                            <a class="{{ request('tab') == 'redeem-code' ? 'border-b-red-600 text-red-600' : '' }} inline-block rounded-t-lg border-b-2 border-transparent px-4 pb-2" href="{{ route('client.profile.promotion', ['tab' => 'redeem-code']) }}">Đổi
                                mã giảm giá</a>
                        </li>
                    </ul>
                </div>

                {{-- my-code --}}
                @switch($tab)
                    @case(null)
                    @case('my-code')
                        <div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2">
                            @foreach ($promotions as $promotion)
                                <div class="product-card flex items-start justify-between p-4">
                                    <div class="space-y-2 text-sm">
                                        <p class="font-medium">
                                            <span class="code me-2 uppercase">{{ $promotion->promotion->code }}</span>
                                        </p>
                                        <p>Giảm {{ $promotion->promotion->discount_type == 1 ? $promotion->promotion->discount_value . '%' : number_format($promotion->promotion->discount_value) . 'đ' }} cho đơn tối thiểu {{ number_format($promotion->promotion->min_order_total) }} đ</p>
                                        <p>Giảm tối đa {{ number_format($promotion->promotion->max_discount) }} đ</p>
                                        <p>Có hiệu lực từ <span class="font-medium">{{ $promotion->promotion->start_date }}</span> đến
                                            <span class="font-medium">{{ $promotion->promotion->end_date }}</span>
                                        </p>
                                    </div>
                                    <div>
                                        <button class="button-red copy-btn">
                                            @svg('tabler-copy', 'icon-sm')
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="p-1">
                            {{ $promotions->links() }}
                        </div>
                    @break

                    {{-- redeem-code --}}
                    @case('redeem-code')
                        <div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2">
                            @foreach ($promotions as $promotion)
                                <div class="product-card flex items-start justify-between p-4">
                                    <div class="space-y-2 text-sm">
                                        <p class="font-medium">
                                            <span class="me-2 uppercase">{{ $promotion->code }}</span>
                                            <span class="badge-light inline-flex items-center">{{ $promotion->points }} @svg('tabler-coins', 'icon-sm ms-2')</span>
                                        </p>
                                        <p>Giảm {{ $promotion->discount_type == 1 ? $promotion->discount_value . '%' : number_format($promotion->discount_value) . 'đ' }} cho đơn tối thiểu {{ number_format($promotion->min_order_total) }} đ</p>
                                        <p>Giảm tối đa {{ number_format($promotion->max_discount) }} đ</p>
                                        <p>Có hiệu lực từ <span class="font-medium">{{ $promotion->start_date }}</span> đến
                                            <span class="font-medium">{{ $promotion->end_date }}</span>
                                        </p>
                                    </div>
                                    <div>
                                        <button class="button-red">
                                            Lưu
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="p-1">
                            {{ $promotions->links() }}
                        </div>
                    @break

                    @default
                        <div>
                            khoong tim thay trang
                        </div>
                @endswitch

            </div>

        </div>
    </div>

    <script>
        const copyButtons = document.querySelectorAll('.copy-btn');
        copyButtons.forEach(button => {
            button.addEventListener('click', () => {
                const code = button.parentElement.previousElementSibling.querySelector('.code').innerText;
                navigator.clipboard.writeText(code);
                alert('Đã sao chép mã giảm giá');
            });
        });
    </script>
@endsection
