@extends('layouts.admin')
@section('content')
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden p-4">
        <div>
            <div class="grid grid-cols-2 gap-6 border-b border-gray-200 py-4  lg:grid-cols-4 xl:gap-16">
                <div>
                    <div class="flex ">
                        @svg('tabler-shopping-cart', 'h-7 w-7 text-gray-400 mb-2')
                        <span class="flex items-center font-bold pb-2 text-lg ms-2 text-gray-900 ">24
                        </span>
                    </div>
                    <h3 class="mb-2 text-gray-500 ">Đơn hàng</h3>
                </div>
                <div>
                    <div class="flex">
                        @svg('tabler-star', 'h-7 w-7 text-gray-400 mb-2')
                        <span class="flex items-center font-bold pb-2 text-lg ms-2 text-gray-900 ">16
                        </span>
                    </div>
                    <h3 class="mb-2 text-gray-500 ">Đánh giá</h3>
                </div>
                <div>
                    <div class="flex">
                        @svg('tabler-heart', 'h-7 w-7 text-gray-400 mb-2')
                        <span class="flex items-center font-bold pb-2 text-lg ms-2 text-gray-900 ">8
                        </span>
                    </div>
                    <h3 class="mb-2 text-gray-500 ">Yêu thích</h3>
                </div>
                <div>
                    <div class="flex">
                        @svg('tabler-refresh', 'h-7 w-7 text-gray-400 mb-2')
                        <span class="flex items-center font-bold pb-2 text-lg ms-2 text-gray-900 ">2
                        </span>
                    </div>
                    <h3 class="mb-2 text-gray-500 ">Trả hàng</h3>
                </div>
            </div>
            <div class="py-4 md:py-8">
                <div class="mb-4 grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
                    <div class="space-y-4">
                        <div class="flex space-x-4">
                            <img class="h-16 w-16 rounded-lg" src="{{ asset('storage/uploads/avatars/' . $user->avatar) }}"
                                alt="Avatar" />
                            <div>
                                <div class="flex ms-2">
                                    <span class="flex items-center">@svg('tabler-circle-filled', 'w-3 h-3 text-green-500')</span>
                                    <span
                                        class="inline-block rounded bg-primary-100 px-1 text-xs font-medium text-primary-800 ">
                                        {{ $user->username }}
                                    </span>
                                </div>
                                <h2
                                    class="flex items-center text-xl font-bold ms-2 mt-2 leading-none text-gray-900  sm:text-2xl">
                                    {{ $user->fullname }} </h2>
                            </div>
                        </div>
                        <dl class="">
                            <dt class="font-semibold text-gray-900 ">Email</dt>
                            <dd class="text-gray-500 ">{{ $user->email }}</dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 ">Địa chỉ giao hàng</dt>
                            <dd class="flex items-center mt-2 gap-1 text-gray-500 ">
                                @svg('tabler-map-pin-filled', 'h-5 w-5 text-gray-400 me-1')
                                2 Miles Drive, NJ 071, New York, United States of America
                            </dd>
                        </dl>
                    </div>
                    <div class="space-y-4">
                        <dl>
                            <dt class="font-semibold text-gray-900 ">Số điện thoại</dt>
                            <dd class="text-gray-500 ">0382606012</dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 ">Ngày sinh</dt>
                            <dd class="text-gray-500 ">13/07/2004</dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 ">Giới tính</dt>
                            <dd class="text-gray-500 ">Nam</dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 ">Vai trò</dt>
                            <dd
                                class="me-2 mt-1.5 text-red-500 inline-flex shrink-0 items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium">
                                Admin
                            </dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 ">Trạng thái</dt>
                            <dd class="text-gray-500 flex items-center py-1">
                                <div
                                    class="inline-block w-3 h-3 mr-2 {{ $user->status == 1 ? 'bg-green-700' : 'bg-red-700' }} rounded-full">
                                </div>
                                <span>{{ $user->status == 1 ? 'Hoạt động' : 'Khóa' }}</span>
                            </dd>
                        </dl>
                    </div>
                </div>
                <a href="{{ route('admin.users.edit', $user) }}"
                    class="inline-flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-0 sm:w-auto">
                    @svg('tabler-edit', 'h-5 w-5 text-white me-2')
                    Cập nhật người dùng
                </a>
            </div>
            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4   md:p-8">
                <h3 class="text-xl font-semibold text-gray-900 ">Danh sách đơn hàng</h3>
                <div class="flex flex-wrap items-center gap-y-4 border-b border-gray-200 pb-4 mt-4 md:pb-5">
                    <dl class="w-1/2 sm:w-48">
                        <dt class="text-base font-medium text-gray-500 ">Mã đơn hàng:</dt>
                        <dd class="mt-1.5 text-base font-semibold text-gray-900 ">
                            <a href="#" class="hover:underline">#FWB12546798</a>
                        </dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 md:flex-1 lg:w-auto">
                        <dt class="text-base font-medium text-gray-500 ">Ngày đặt hàng:</dt>
                        <dd class="mt-1.5 text-base font-semibold text-gray-900 ">11.12.2023</dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/5 md:flex-1 lg:w-auto">
                        <dt class="text-base font-medium text-gray-500 ">Đơn giá:</dt>
                        <dd class="mt-1.5 text-base font-semibold text-gray-900 ">$499</dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 sm:flex-1 lg:w-auto">
                        <dt class="text-base font-medium text-gray-500 ">Trạng thái:</dt>
                        <dd
                            class="me-2 mt-1.5 inline-flex shrink-0 items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 ">
                            @svg('tabler-truck', 'h-3 w-3 me-1')
                            In transit
                        </dd>
                    </dl>

                    <div class="w-full sm:flex sm:w-32 sm:items-center sm:justify-end sm:gap-4">
                        <a href="{{ route('admin.orders.show', 1) }}"
                            class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0 md:w-auto">
                            @svg('tabler-external-link', 'h-4 w-4 me-1.5')
                            Chi tiết
                        </a>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-y-4 border-b border-gray-200 pb-4 mt-4 md:pb-5">
                    <dl class="w-1/2 sm:w-48">
                        <dt class="text-base font-medium text-gray-500 ">Mã đơn hàng:</dt>
                        <dd class="mt-1.5 text-base font-semibold text-gray-900 ">
                            <a href="#" class="hover:underline">#FWB12546798</a>
                        </dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 md:flex-1 lg:w-auto">
                        <dt class="text-base font-medium text-gray-500 ">Ngày đặt hàng:</dt>
                        <dd class="mt-1.5 text-base font-semibold text-gray-900 ">11.12.2023</dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/5 md:flex-1 lg:w-auto">
                        <dt class="text-base font-medium text-gray-500 ">Đơn giá:</dt>
                        <dd class="mt-1.5 text-base font-semibold text-gray-900 ">$499</dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 sm:flex-1 lg:w-auto">
                        <dt class="text-base font-medium text-gray-500 ">Trạng thái:</dt>
                        <dd
                            class="me-2 mt-1.5 inline-flex shrink-0 items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 ">
                            @svg('tabler-truck', 'h-3 w-3 me-1')
                            In transit
                        </dd>
                    </dl>

                    <div class="w-full sm:flex sm:w-32 sm:items-center sm:justify-end sm:gap-4">
                        <a href="{{ route('admin.orders.show', 1) }}"
                            class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0 md:w-auto">
                            @svg('tabler-external-link', 'h-4 w-4 me-1.5')
                            Chi tiết
                        </a>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-y-4 border-b border-gray-200 pb-4 mt-4 md:pb-5">
                    <dl class="w-1/2 sm:w-48">
                        <dt class="text-base font-medium text-gray-500 ">Mã đơn hàng:</dt>
                        <dd class="mt-1.5 text-base font-semibold text-gray-900 ">
                            <a href="#" class="hover:underline">#FWB12546798</a>
                        </dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 md:flex-1 lg:w-auto">
                        <dt class="text-base font-medium text-gray-500 ">Ngày đặt hàng:</dt>
                        <dd class="mt-1.5 text-base font-semibold text-gray-900 ">11.12.2023</dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/5 md:flex-1 lg:w-auto">
                        <dt class="text-base font-medium text-gray-500 ">Đơn giá:</dt>
                        <dd class="mt-1.5 text-base font-semibold text-gray-900 ">$499</dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 sm:flex-1 lg:w-auto">
                        <dt class="text-base font-medium text-gray-500 ">Trạng thái:</dt>
                        <dd
                            class="me-2 mt-1.5 inline-flex shrink-0 items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 ">
                            @svg('tabler-truck', 'h-3 w-3 me-1')
                            In transit
                        </dd>
                    </dl>

                    <div class="w-full sm:flex sm:w-32 sm:items-center sm:justify-end sm:gap-4">
                        <a href="{{ route('admin.orders.show', 1) }}"
                            class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0 md:w-auto">
                            @svg('tabler-external-link', 'h-4 w-4 me-1.5')
                            Chi tiết
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
