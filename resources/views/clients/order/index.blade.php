@extends('layouts.client')

@section('title', 'Lịch sử đơn hàng')

@section('content')
    <div class="min-h-screen">
        <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
            <p class="title">LỊCH SỬ ĐƠN HÀNG</p>

            {{-- tabs --}}
            <div class="no-scrollbar mb-4 overflow-x-auto border-b border-gray-200 text-left text-sm">
                <ul class="flex">
                    <li class="me-6 min-w-fit">
                        <a aria-current="page" class="inline-block rounded-t-lg border-b-2 border-red-600 pb-2 text-red-600" href="{{ route('client.order.index', ['tab' => 'all']) }}">Tất cả</a>
                    </li>

                    @foreach ($orderStatuses as $status)
                        <li class="me-6 min-w-fit">
                            <a aria-current="page" class="inline-block rounded-t-lg border-b-2 border-transparent pb-2" href="{{ route('client.order.index', ['tab' => $status->slug]) }}">{{ $status->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Danh sách đơn hàng --}}
            @for ($j = 0; $j < 10; $j++)
                <div class="product-card mb-4 p-4 hover:cursor-pointer">
                    <div class="" onclick="toggleAccordion({{ $j }})">
                        <div class="mb-2 space-y-4 text-sm">
                            <div class="flex items-center">
                                <p class="text-base font-medium">#157R3-180924</p>
                                <div class="ms-auto space-x-2">
                                    <span class="badge-red">Đang chờ xác nhận</span>
                                </div>
                            </div>

                        </div>
                        <div class="mb-4 flex items-start justify-between">
                            <div class="flex items-center gap-2">
                                <span class="badge-light">12:00:23</span>
                                <span class="badge-light">24/06/2024</span>
                            </div>
                            <div class="text-right">
                                <p class="font-light text-sm text-gray-600 line-through">325,000đ</p>
                                <p class="text-base font-medium">248,000đ</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-4">
                            <a class="link-md" href="#">Huỷ đơn</a>
                            <a class="link-md" href="#">Xem hoá đơn</a>
                        </div>
                    </div>

                    <div class="max-h-0 overflow-hidden transition" id="content-{{ $j }}">
                        <hr class="my-4">
                        <div class="pb-5 text-sm">
                            <p class="mb-4 text-base font-medium">Thông tin chi tiết</p>
                            <div class="flex items-start justify-between">
                                <div class="mb-4">
                                    <p class="mb-2 font-medium">Phương thức thanh toán</p>
                                    <p>Thanh toán khi nhận hàng</p>
                                </div>
                                <div class="text-right">
                                    <p class="mb-2 font-medium">Người nhận</p>
                                    <p>Đỗ Hồng Quân</p>
                                    <p>0362303364</p>
                                    <p>Số 4 ngách 132/66/2, Nguyên Xá, Bắc Từ Liêm, Hà Nội</p>
                                </div>
                            </div>
                        </div>

                        {{-- Danh sách sản phẩm --}}
                        <hr class="my-4">
                        <div class="pb-5 text-sm">
                            <p class="mb-4 text-base font-medium">Danh sách sản phẩm</p>
                            <div class="grid grid-cols-1 gap-4 md:px-4 lg:grid-cols-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="product-card overflow-hidden">
                                        <div class="flex w-full items-center justify-between">
                                            <div class="flex gap-4">
                                                <img alt="" class="h-32 w-24 object-cover" loading="lazy" src="{{ asset('storage/uploads/products/pizza/pizza-ca-tim.jpeg') }}">
                                                <div class="py-2 text-left">
                                                    <p class="mb-2 font-medium">Pizza xúc xích</p>
                                                    <div class="mb-4 text-sm">
                                                        <p>Đế mỏng, size S</p>
                                                        <p>Topping: Thịt bò, cá hồi</p>
                                                    </div>
                                                    <div class="flex items-center gap-2 text-sm">
                                                        <span class="line-through">320,000đ</span>
                                                        <span class="font-medium">300,000đ</span>
                                                    </div>
                                                </div>
                                            </div>
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
