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
                            <a aria-current="page"
                                class="{{ request('tab') == 'my-code' ? 'border-b-red-600 text-red-600' : '' }} inline-block rounded-t-lg border-b-2 px-4 pb-2"
                                href="{{ route('client.profile.promotion', ['tab' => 'my-code']) }}">Mã
                                giảm giá của tôi (13)</a>
                        </li>
                        <li class="me-2">
                            <a class="{{ request('tab') == 'redeem-code' ? 'border-b-red-600 text-red-600' : '' }} inline-block rounded-t-lg border-b-2 border-transparent px-4 pb-2 "
                                href="{{ route('client.profile.promotion', ['tab' => 'redeem-code']) }}">Đổi
                                mã giảm giá</a>
                        </li>
                    </ul>
                </div>

                {{-- my codes --}}
                {{-- <div class="grid grid-cols-2 gap-4">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="product-card p-4 flex items-start justify-between">
                            <div class="text-sm space-y-2">
                                <p class="font-medium">
                                    <span class="uppercase me-2">AOHDJRNF</span>
                                    <span class="badge-light">Hết hạn</span>
                                </p>
                                <p>Giảm 20% cho đơn tối thiểu 300,000đ</p>
                                <p>Giảm tối đa 30,000đ</p>
                                <p>Có hiệu lực từ <span class="font-medium">25-07-2024</span> đến <span class="font-medium">25-07-2024</span></p>
                            </div>
                            <div>
                                <button class="button-red">
                                    @svg('tabler-copy', 'icon-sm')
                                </button>
                            </div>
                        </div>
                    @endfor
                </div> --}}

                {{-- redeem-code --}}
                @switch($tab)
                    @case(null)
                    @case('my-code')
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mb-8">
                            @foreach ($promotions as $promotion)
                                <div class="product-card flex items-start justify-between p-4">
                                    <div class="space-y-2 text-sm">
                                        <p class="font-medium">
                                            <span class="me-2 uppercase code" >{{ $promotion->promotion->code }}</span>
                                        </p>
                                        <p >Giảm {{ ($promotion->promotion->discount_type == 1) ? $promotion->promotion->discount_value . '%' : number_format($promotion->promotion->discount_value) .'đ'}} cho đơn tối thiểu {{  number_format($promotion->promotion->min_order_total) }} đ</p>
                                        <p>Giảm tối đa {{  number_format($promotion->promotion->max_discount) }} đ</p>
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

                    @case('redeem-code')
                       
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mb-8">
                                @foreach ($promotions as $promotion)
                                <div class="product-card flex items-start justify-between p-4">
                                    <div class="space-y-2 text-sm">
                                        <p class="font-medium">
                                            <span class="me-2 uppercase">{{ $promotion->code }}</span>
                                            <span class="badge-light inline-flex items-center">450 @svg('tabler-coins', 'icon-sm ms-2')</span>
                                        </p>
                                        <p>Giảm 20% cho đơn tối thiểu {{ $promotion->min_order_total }}</p>
                                        <p>Giảm tối đa {{ $promotion->max_discount }} </p>
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
            button.onclick() 
            
        });
    </script>
@endsection
