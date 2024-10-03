@extends('layouts.client')

@section('title', 'Lịch sử đơn hàng')

@section('content')
    <div class="min-h-screen">
        <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
            <p class="title">LỊCH SỬ ĐƠN HÀNG</p>

            {{-- tabs --}}
            <div
                class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 mb-4 overflow-x-auto no-scrollbar">
                <ul class="flex -mb-px">
                    <li class="me-2 min-w-32">
                        <a href="{{ route('client.order.index', ['tab' => 'all']) }}"
                            class="inline-block px-4 pb-2 text-red-600 border-b-2 border-red-600 rounded-t-lg"
                            aria-current="page">Tất cả</a>
                    </li>
                    <li class="me-2 min-w-32">
                        <a href="{{ route('client.order.index', ['tab' => 'wait']) }}"
                            class="inline-block px-4 pb-2 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Chờ
                            xác nhận</a>
                    </li>
                    <li class="me-2 min-w-32">
                        <a href="{{ route('client.order.index', ['tab' => 'delivering']) }}"
                            class="inline-block px-4 pb-2 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Đang
                            giao hàng</a>
                    </li>
                    <li class="me-2 min-w-32">
                        <a href="{{ route('client.order.index', ['tab' => 'completed']) }}"
                            class="inline-block px-4 pb-2 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Hoàn
                            thành</a>
                    </li>
                    <li class="me-2 min-w-32">
                        <a href="{{ route('client.order.index', ['tab' => 'canceled']) }}"
                            class="inline-block px-4 pb-2 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Đã
                            huỷ</a>
                    </li>
                </ul>
            </div>

            {{-- Danh sách đơn hàng --}}
            @for ($j = 0; $j < 10; $j++)
                <div class="product-card hover:cursor-pointer p-4 mb-4">
                    <div onclick="toggleAccordion({{ $j }})" class="flex items-center justify-between gap-4">
                        <div class="text-sm space-y-4">
                            <div class="flex items-center gap-2">
                                <p class="font-medium text-base">Đơn hàng #157R3-180924</p>
                                <span class="badge-red">Đang chờ xác nhận</sp>
                            </div>
                            <p class="font-medium">
                                Thời gian tạo:
                                <span class="badge-light">12:00:23</span>
                                <span class="badge-light">24/06/2024</span>
                            </p>
                        </div>
                        <div class="flex items-center gap-8">
                            <div class="space-y-2 text-right">
                                <p class="text-sm line-through">380,000đ</p>
                                <p class="font-medium">300,000đ</p>
                            </div>
                            <button class="button-red">Huỷ đơn</button>
                        </div>
                    </div>

                    <div id="content-{{ $j }}" class="max-h-0 overflow-hidden transition">
                        <hr class="my-4">
                        <div class="pb-5 text-sm">
                            <p class="font-medium text-base mb-4">Thông tin chi tiết</p>
                            <div>
                                <p>Phương thức thanh toán</p>
                                <p class="font-medium">Thanh toán khi nhận hàng</p>
                            </div>
                        </div>

                        {{-- Danh sách sản phẩm --}}
                        <hr class="my-4">
                        <div class="pb-5 text-sm">
                            <p class="font-medium text-base mb-4">Danh sách sản phẩm</p>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:px-4">
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="product-card overflow-hidden">
                                        <div class="w-full flex justify-between items-center pe-4">
                                            <div class="flex gap-4">
                                                <img src="{{ asset('storage/uploads/products/pizza/pizza_tartufo.png') }}"
                                                    class="img-md" alt="">
                                                <div class="text-left py-2">
                                                    <p class="font-medium mb-4">Pizza xúc xích</p>
                                                    <div class="text-sm">
                                                        <p>Đế mỏng, size S</p>
                                                        <p>Topping: Thịt bò, cá hồi</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="mb-4 text-sm flex items-center gap-2">
                                                    <span class="line-through">320,000đ</span>
                                                    <span class="font-medium">300,000đ</span>
                                                </div>
                                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                                    <button type="button"
                                                        class="px-2 py-1.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-red-500">
                                                        @svg('tabler-minus', 'icon-sm')
                                                    </button>
                                                    <div
                                                        class="px-4 py-1.5 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200">
                                                        1
                                                    </div>
                                                    <button type="button"
                                                        class="px-2 py-1.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-red-500">
                                                        @svg('tabler-plus', 'icon-sm')
                                                    </button>
                                                </div>
                                            </div>
                                            <a href="#">
                                                @svg('tabler-trash', 'icon-md text-red-600')
                                            </a>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                </div>
            @endfor
        </div>
    </div>

    <script>
        function toggleAccordion(index) {
            const content = document.getElementById(`content-${index}`);

            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                content.style.maxHeight = '0';
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        }
    </script>
@endsection
