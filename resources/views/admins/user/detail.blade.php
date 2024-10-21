@extends('layouts.admin')
@section('title', 'Người dùng | Chi tiết')
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
                            <a class="shrink-0 me-2" data-fslightbox="gallery" href="{{ Auth::user()->avatar() }}">
                                <img loading="lazy" class="h-16 w-16 rounded-lg" src="{{ Auth::user()->avatar() }}"
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
                                            {{ $address->detail_address . ', ' . $address->ward . ', ' . $address->district . ', ' . $address->province }}
                                        </span>
                                        <span data-modal-target="default-modal" data-modal-toggle="default-modal">
                                            @svg('tabler-pencil', 'h-5 w-5 text-blue-400 mx-1')
                                        </span>
                                    </div>

                                    <!-- Main modal -->
                                    <div id="default-modal" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                    <h3 class="text-xl font-semibold text-gray-900">
                                                        Cập nhật địa chỉ
                                                    </h3>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                        data-modal-hide="default-modal">
                                                        @svg('tabler-x', 'w-4 h-4')
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 space-y-4">
                                                    <form action="#" method="PUT">
                                                        @csrf
                                                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                            <div class="sm:col-span-2">
                                                                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                                                                    <div>
                                                                        <label for="province"
                                                                            class="block mb-2 text-sm font-medium text-gray-900 ">Tỉnh/Thành</label>
                                                                        <select id="province" name="province"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                                            <option selected="">Tỉnh/Thành</option>
                                                                            <option value="1">Nam</option>
                                                                            <option value="2">Nữ</option>
                                                                            <option value="3">Khác</option>
                                                                        </select>
                                                                        @error('province')
                                                                            <p class="mt-2 text-sm text-red-600 ">
                                                                                {{ $message }}
                                                                            </p>
                                                                        @enderror
                                                                    </div>
                                                                    <div>
                                                                        <label for="district"
                                                                            class="block mb-2 text-sm font-medium text-gray-900 ">Huyện/Tỉnh</label>
                                                                        <select id="district" name="district"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                                            <option value="1">Nam</option>
                                                                            <option value="2">Nữ</option>
                                                                            <option value="3">Khác</option>
                                                                        </select>
                                                                        @error('district')
                                                                            <p class="mt-2 text-sm text-red-600 ">
                                                                                {{ $message }}
                                                                            </p>
                                                                        @enderror
                                                                    </div>
                                                                    <div>
                                                                        <label for="ward"
                                                                            class="block mb-2 text-sm font-medium text-gray-900 ">Phường/Xã</label>
                                                                        <select id="ward" name="ward"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                                            <option value="1">Nam</option>
                                                                            <option value="2">Nữ</option>
                                                                            <option value="3">Khác</option>
                                                                        </select>
                                                                        @error('ward')
                                                                            <p class="mt-2 text-sm text-red-600 ">
                                                                                {{ $message }}
                                                                            </p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="sm:col-span-2">
                                                                <label for="detail_address"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 ">Địa
                                                                    chỉ</label>
                                                                <input type="text" name="detail_address"
                                                                    id="detail_address" placeholder="Địa chỉ"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                                @error('detail_address')
                                                                    <p class="mt-2 text-sm text-red-600 ">
                                                                        {{ $message }}
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                            <div class="sm:col-span-2">
                                                                <div class="mr-5">
                                                                    <input id="is_default" type="checkbox" value=""
                                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-0">
                                                                    <label for="is_default"
                                                                        class="ms-2 text-sm font-medium text-gray-900">Địa
                                                                        chỉ mặc định</label>
                                                                </div>
                                                                @error('is_default')
                                                                    <p class="mt-2 text-sm text-red-600 ">
                                                                        {{ $message }}
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center space-x-4 mt-5">
                                                            <span data-modal-hide="default-modal"
                                                                class="button-dark cursor-pointer">
                                                                Quay lại
                                                            </span>
                                                            <button type="submit" class="button-blue">
                                                                Cập nhật
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </dd>
                            @endforeach
                            <dd>
                                <button class="flex items-center my-3 gap-1 text-blue-500" data-modal-target="add-address"
                                    data-modal-toggle="add-address">
                                    @svg('tabler-plus', 'h-5 w-5 me-1')
                                    Thêm địa chỉ
                                </button>
                                <!-- Main modal -->
                                <div id="add-address" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                <h3 class="text-xl font-semibold text-gray-900">
                                                    Thêm địa chỉ mới
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                    data-modal-hide="add-address">
                                                    @svg('tabler-x', 'w-4 h-4')
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                <form action="#" method="PUT">
                                                    @csrf
                                                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                        <div class="sm:col-span-2">
                                                            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                                                                <div>
                                                                    <label for="province"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 ">Tỉnh/Thành</label>
                                                                    <select id="province" name="province"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                                        <option selected="">Tỉnh/Thành</option>
                                                                        <option value="1">Nam</option>
                                                                        <option value="2">Nữ</option>
                                                                        <option value="3">Khác</option>
                                                                    </select>
                                                                    @error('province')
                                                                        <p class="mt-2 text-sm text-red-600 ">
                                                                            {{ $message }}
                                                                        </p>
                                                                    @enderror
                                                                </div>
                                                                <div>
                                                                    <label for="district"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 ">Huyện/Tỉnh</label>
                                                                    <select id="district" name="district"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                                        <option value="1">Nam</option>
                                                                        <option value="2">Nữ</option>
                                                                        <option value="3">Khác</option>
                                                                    </select>
                                                                    @error('district')
                                                                        <p class="mt-2 text-sm text-red-600 ">
                                                                            {{ $message }}
                                                                        </p>
                                                                    @enderror
                                                                </div>
                                                                <div>
                                                                    <label for="ward"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 ">Phường/Xã</label>
                                                                    <select id="ward" name="ward"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                                        <option value="1">Nam</option>
                                                                        <option value="2">Nữ</option>
                                                                        <option value="3">Khác</option>
                                                                    </select>
                                                                    @error('ward')
                                                                        <p class="mt-2 text-sm text-red-600 ">
                                                                            {{ $message }}
                                                                        </p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="sm:col-span-2">
                                                            <label for="detail_address"
                                                                class="block mb-2 text-sm font-medium text-gray-900 ">Địa
                                                                chỉ</label>
                                                            <input type="text" name="detail_address"
                                                                id="detail_address" placeholder="Địa chỉ"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                            @error('detail_address')
                                                                <p class="mt-2 text-sm text-red-600 ">
                                                                    {{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div class="sm:col-span-2">
                                                            <div class="mr-5">
                                                                <input id="is_default" type="checkbox" value=""
                                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-0">
                                                                <label for="is_default"
                                                                    class="ms-2 text-sm font-medium text-gray-900">Địa
                                                                    chỉ mặc định</label>
                                                            </div>
                                                            @error('is_default')
                                                                <p class="mt-2 text-sm text-red-600 ">
                                                                    {{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center space-x-4 mt-5">
                                                        <span data-modal-hide="add-address"
                                                            class="button-dark cursor-pointer">
                                                            Quay lại
                                                        </span>
                                                        <button type="submit" class="button-blue">
                                                            Cập nhật
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </dd>
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
                    <a href="{{ url()->previous() }}" class="button-dark me-2">
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
                                {{ number_format($order->amount) }}đ
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
