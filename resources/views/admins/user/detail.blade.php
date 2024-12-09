@extends('layouts.admin')
@section('title', 'Tài khoản | Chi tiết')
@section('content')
    {{ Breadcrumbs::render('admin.users.show', $user) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden p-4">
        <div>
            <div class="grid grid-cols-2 gap-6 border-b border-gray-200 py-4  lg:grid-cols-4 xl:gap-16">
                <div>
                    <div class="flex ">
                        @svg('tabler-shopping-cart', 'h-7 w-7 text-gray-400 mb-2')
                        <span class="flex items-center font-bold pb-2 text-lg ms-2 text-gray-900 ">{{ count($orders) ?? 0 }}
                        </span>
                    </div>
                    <h3 class="mb-2 text-gray-500 ">Đơn hàng</h3>
                </div>
                <div>
                    <div class="flex">
                        @svg('tabler-star', 'h-7 w-7 text-gray-400 mb-2')
                        <span
                            class="flex items-center font-bold pb-2 text-lg ms-2 text-gray-900 ">{{ count($evaluations) ?? 0 }}
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
                        <span class="flex items-center font-bold pb-2 text-lg ms-2 text-gray-900 ">
                            {{ count($orders->where('status', 4)) }}
                        </span>
                    </div>
                    <h3 class="mb-2 text-gray-500 ">Trả hàng</h3>
                </div>
            </div>
            <div class="py-4 md:py-8">
                <div class="mb-4 grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
                    <div class="space-y-4">
                        <div class="flex space-x-4">
                            <a class="shrink-0 me-2" data-fslightbox="gallery" href="{{ $user->avatar() }}">
                                <img loading="lazy" class="h-16 w-16 rounded-lg object-cover" src="{{ $user->avatar() }}"
                                    alt="Avatar" />
                            </a>
                            <div>
                                <div class="flex">
                                    <span
                                        class="flex items-center {{ $user->status == 1 ? 'text-green-500' : 'text-red-500' }}">@svg('tabler-circle-filled', 'w-3 h-3')</span>
                                    <span
                                        class="inline-block rounded bg-primary-100 px-1 text-xs font-medium text-primary-800 ">
                                        {{ $user->username }}
                                    </span>
                                </div>
                                <h2 class="flex items-center text-xl font-bold mt-2 leading-none text-gray-900">
                                    {{ $user->fullname }}
                                </h2>
                            </div>
                        </div>
                        <dl class="">
                            <dt class="font-semibold text-gray-900 ">Email</dt>
                            <dd class="text-gray-500 ">{{ $user->email }}</dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 ">Địa chỉ giao hàng</dt>
                            @foreach ($addresses as $address)
                                <dd class="mt-2 text-gray-500">
                                    <div class="flex">
                                        <span>•
                                            {{ $address->detail_address . ', ' . $address->ward->name_with_type . ', ' . $address->district->name_with_type . ', ' . $address->province->name_with_type }}
                                            @if ($address->is_default == 1)
                                                <span
                                                    class="me-2 text-[#D30A0A] inline-flex shrink-0 items-center rounded bg-red-100 px-2 py-0.5 text-xs font-medium">Mặc
                                                    định</span>
                                            @endif
                                        </span>
                                    </div>
                                </dd>
                            @endforeach
                        </dl>
                    </div>
                    <div class="space-y-4 overflow-x-auto">
                        <dl>
                            <dt class="font-semibold text-gray-900 ">Số điện thoại</dt>
                            <dd class="text-gray-500 ">{{ $user->phone }}</dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 ">Ngày sinh</dt>
                            <dd class="text-gray-500 ">{{ $user->date_of_birth }}</dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 ">Giới tính</dt>
                            <dd class="text-gray-500 ">
                                @if ($user->gender == 1)
                                    Nam
                                @elseif ($user->gender == 2)
                                    Nữ
                                @else
                                    Khác
                                @endif
                            </dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 ">Vai trò</dt>
                            <dd
                                class="me-2 mt-1.5 {{ $user->role_id == 2 ? 'text-blue-500 bg-blue-100' : 'text-red-500 bg-yellow-100' }} inline-flex shrink-0 items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium">
                                {{ $user->role_id == 2 ? 'Khách hàng' : 'Quản trị viên' }}
                            </dd>
                            @if ($user->role->parent_id == 1)
                                <dd
                                    class="me-2 mt-1.5 text-red-500 inline-flex shrink-0 items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium">
                                    {{ $user->role->name }}
                                </dd>
                            @endif
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 ">Trạng thái</dt>
                            <dd class="text-gray-500 flex items-center py-1">
                                <div
                                    class="inline-block indicator {{ $user->status == 1 ? 'bg-green-700' : 'bg-red-700' }} rounded-full">
                                </div>
                                <span>{{ $user->status == 1 ? 'Hoạt động' : 'Khóa' }}</span>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="flex items-start">
                    <a href="{{ route('admin.users.index') }}" class="button-gray me-2">
                        @svg('tabler-arrow-back-up', 'h-5 w-5 text-white me-2')
                        Quay lại
                    </a>
                    <a href="{{ route('admin.users.edit', $user) }}" class="button-blue me-2">
                        @svg('tabler-edit', 'h-5 w-5 text-white me-2')
                        Cập nhật tài khoản
                    </a>
                </div>
            </div>
            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4   md:p-8">
                <h3 class="text-xl font-semibold text-gray-900 ">Danh sách đơn hàng</h3>
                @forelse ($orders as $order)
                    <div class="flex flex-wrap items-center gap-y-4 border-b border-gray-200 pb-4 mt-4 md:pb-5">
                        <dl class="w-1/2 sm:w-48">
                            <dt class="text-base font-medium text-gray-500 ">Mã đơn hàng:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900 ">
                                <a href="#" class="hover:underline">#{{ $order->id }}</a>
                            </dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 md:flex-1 lg:w-auto">
                            <dt class="text-base font-medium text-gray-500 ">Ngày đặt hàng:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900 ">
                                {{ $order->created_at->format('d/m/Y') }}
                            </dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/5 md:flex-1 lg:w-auto">
                            <dt class="text-base font-medium text-gray-500 ">Đơn giá:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900 ">
                                {{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}₫
                            </dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 sm:flex-1 lg:w-auto">
                            <dt class="text-base font-medium text-gray-500 ">Trạng thái:</dt>
                            @php
                                $colorClasses = [
                                    'yellow' => 'bg-yellow-500',
                                    'blue' => 'bg-blue-500',
                                    'gray' => 'bg-gray-500',
                                    'green' => 'bg-green-600',
                                    'red' => 'bg-red-600',
                                ];

                                $colorClass = $colorClasses[$order->orderStatus->color] ?? 'bg-gray-500';
                            @endphp
                            <dd
                                class="me-2 mt-1.5 inline-flex shrink-0 items-center rounded px-2.5 py-0.5 text-xs font-medium text-white {{ $colorClass }}">
                                {{ $order->orderStatus->name }}
                            </dd>
                        </dl>

                        <div class="w-full sm:flex sm:w-32 sm:items-center sm:justify-end sm:gap-4">
                            <a href="{{ route('admin.orders.edit', $order) }}"
                                class=" flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0 md:w-auto">
                                @svg('tabler-external-link', 'h-4 w-4 me-1.5')
                                Chi tiết
                            </a>
                        </div>
                    </div>
                @empty
                    <dl class="w-1/2 sm:w-1/4 sm:flex-1 lg:w-auto">
                        <div class="flex flex-col items-center justify-center p-6 rounded-lg w-full h-80">
                            @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                            <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                        </div>
                    </dl>
                @endforelse
                <div class="py-4">
                    {{ $orders->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
