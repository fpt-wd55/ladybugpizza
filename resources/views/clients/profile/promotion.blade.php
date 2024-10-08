@extends('layouts.client')

@section('title', 'Mã giảm giá')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="lg:flex">

            @include('clients.profile.sidebar')

            <div class="card p-4 md:p-8 w-full min-h-screen">
                <h3 class="font-semibold uppercase mb-8">Mã giảm giá</h3>

                {{-- tabs --}}
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 mb-4">
                    <ul class="flex flex-wrap -mb-px">
                        <li class="me-2">
                            <a href="{{ route('client.profile.promotion', ['tab' => 'my-code']) }}"
                                class="inline-block px-4 pb-2 text-red-600 border-b-2 border-red-600 rounded-t-lg"
                                aria-current="page">Mã
                                giảm giá của tôi (13)</a>
                        </li>
                        <li class="me-2">
                            <a href="{{ route('client.profile.promotion', ['tab' => 'redeem-code']) }}"
                                class="inline-block px-4 pb-2 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Đổi
                                Mã giảm giá</a>
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="product-card p-4 flex items-start justify-between">
                            <div class="text-sm space-y-2">
                                <p class="font-medium">
                                    <span class="uppercase me-2">AOHDJRNF</span>
                                    <span class="badge-yellow inline-flex items-center">450 @svg('tabler-coins', 'icon-sm ms-2')</span>
                                </p>
                                <p>Giảm 20% cho đơn tối thiểu 300,000đ</p>
                                <p>Giảm tối đa 30,000đ</p>
                                <p>Có hiệu lực từ <span class="font-medium">25-07-2024</span> đến <span
                                        class="font-medium">25-07-2024</span></p>
                            </div>
                            <div>
                                <button class="button-red">
                                    Lưu
                                </button>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
