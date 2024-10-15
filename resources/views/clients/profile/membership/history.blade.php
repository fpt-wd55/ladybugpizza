@extends('layouts.client')

@section('title', 'Lịch sử sử dụng điểm')

@section('content')
    <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
        <div class="lg:flex">
            @include('clients.profile.sidebar')

            <div class="card mb-8 w-full p-4 md:p-8">
                <h3 class="mb-8 font-semibold uppercase">Lịch sử sử dụng điểm</h3>

                {{-- tabs --}}
                <div class="mb-4 border-b border-gray-200 text-center text-sm font-medium text-gray-500">
                    <ul class="-mb-px flex flex-wrap">
                        <li class="me-2">
                            <a class="inline-block rounded-t-lg border-b-2 border-transparent px-4 pb-2 hover:border-gray-300 hover:text-gray-600"
                                href="{{ route('client.profile.membership-history', ['tab' => 'receive']) }}">Lịch sử
                                nhận</a>
                        </li>
                        <li class="me-2">
                            <a class="inline-block rounded-t-lg border-b-2 border-transparent px-4 pb-2 hover:border-gray-300 hover:text-gray-600"
                                href="{{ route('client.profile.membership-receive', ['tab' => 'change']) }}">Lịch sử đổi</a>
                        </li>
                    </ul>
                </div>

                {{-- history --}}
                <div>
                    <div class="card p-4 md:p-8">


                        <div class="mb-4 border-b border-gray-300">
                            <button class="flex w-full items-center justify-between py-4">

                                <span class="text-left text-sm font-normal">
                                    <p class="font-thin">Ngày 14/10/2024</p>
                                    <p>Mua hàng tích điểm</p>
                                    <p>vào lúc 08:00 tại LADYBUGPIZZA</p>
                                    <p>Đơn hàng Pizza Pesto Burrata và 2 sản phẩm.</p>
                                </span>

                                <span class="transition text-red-500" id="icon-1">
                                    +1000
                                </span>
                            </button>

                        </div>
                        <div class="mb-4 border-b border-gray-300">
                            <button class="flex w-full items-center justify-between py-4">

                                <span class="text-left text-sm font-normal">
                                    <p class="font-thin">Ngày 14/10/2024</p>
                                    <p>Mua hàng tích điểm</p>
                                    <p>vào lúc 08:00 tại LADYBUGPIZZA</p>
                                    <p>Đơn hàng Pizza Pesto Burrata và 2 sản phẩm.</p>
                                </span>

                                <span class="transition text-red-500" id="icon-1">
                                    +1000
                                </span>
                            </button>

                        </div>
                        <div class="mb-4 border-b border-gray-300">
                            <button class="flex w-full items-center justify-between py-4">

                                <span class="text-left text-sm font-normal">
                                    <p class="font-thin">Ngày 14/10/2024</p>
                                    <p>Mua hàng tích điểm</p>
                                    <p>vào lúc 08:00 tại LADYBUGPIZZA</p>
                                    <p>Đơn hàng Pizza Pesto Burrata và 2 sản phẩm.</p>
                                </span>

                                <span class="transition text-red-500" id="icon-1">
                                    +1000
                                </span>
                            </button>

                        </div>
                        <div class="mb-4 border-b border-gray-300">
                            <button class="flex w-full items-center justify-between py-4">

                                <span class="text-left text-sm font-normal">
                                    <p class="font-thin">Ngày 14/10/2024</p>
                                    <p>Mua hàng tích điểm</p>
                                    <p>vào lúc 08:00 tại LADYBUGPIZZA</p>
                                    <p>Đơn hàng Pizza Pesto Burrata và 2 sản phẩm.</p>
                                </span>

                                <span class="transition text-red-500" id="icon-1">
                                    +1000
                                </span>
                            </button>

                        </div>
                        <div class="mb-4 border-b border-gray-300">
                            <button class="flex w-full items-center justify-between py-4">

                                <span class="text-left text-sm font-normal">
                                    <p class="font-thin">Ngày 14/10/2024</p>
                                    <p>Mua hàng tích điểm</p>
                                    <p>vào lúc 08:00 tại LADYBUGPIZZA</p>
                                    <p>Đơn hàng Pizza Pesto Burrata và 2 sản phẩm.</p>
                                </span>

                                <span class="transition text-red-500" id="icon-1">
                                    +1000
                                </span>
                            </button>

                        </div>
                        <div class="mb-4 border-b border-gray-300">
                            <button class="flex w-full items-center justify-between py-4">

                                <span class="text-left text-sm font-normal">
                                    <p class="font-thin">Ngày 14/10/2024</p>
                                    <p>Mua hàng tích điểm</p>
                                    <p>vào lúc 08:00 tại LADYBUGPIZZA</p>
                                    <p>Đơn hàng Pizza Pesto Burrata và 2 sản phẩm.</p>
                                </span>

                                <span class="transition text-red-500" id="icon-1">
                                    +1000
                                </span>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
