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
                                giảm giá của tôi (13)</a>
                        </li>
                        <li class="me-2">
                            <a class="{{ request('tab') == 'redeem-code' ? 'border-b-red-600 text-red-600' : '' }} inline-block rounded-t-lg border-b-2 border-transparent px-4 pb-2 " href="{{ route('client.profile.promotion', ['tab' => 'redeem-code']) }}">Đổi
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
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="product-card flex items-start justify-between p-4">
                            <div class="space-y-2 text-sm">
                                <p class="font-medium">
                                    <span class="me-2 uppercase">AOHDJRNF</span>
                                    <span class="badge-yellow inline-flex items-center">450 @svg('tabler-coins', 'icon-sm ms-2')</span>
                                </p>
                                <p>Giảm 20% cho đơn tối thiểu 300,000đ</p>
                                <p>Giảm tối đa 30,000đ</p>
                                <p>Có hiệu lực từ <span class="font-medium">25-07-2024</span> đến <span class="font-medium">25-07-2024</span></p>
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
