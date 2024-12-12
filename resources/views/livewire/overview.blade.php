<div>
    <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Tổng quan</h3>
    <div class="my-4 grid w-full grid-cols-2 gap-4 2xl:grid-cols-4">
        <a class="shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-lg border bg-white bg-clip-border transition hover:border-red-600 hover:text-red-600" href="{{ route('admin.users.index') }}">
            <div class="flex-auto p-4">
                <div class="-mx-3 flex flex-row items-center">
                    <div class="w-2/3 max-w-full flex-none px-3">
                        <div>
                            <p class="mb-0 font-sans text-base font-medium leading-normal">Tài khoản</p>
                            <h5 class="mb-0 text-xl font-bold">
                                {{ $overview['users'] }}
                            </h5>
                        </div>
                    </div>
                    <div class="flex basis-1/3 items-center justify-end px-3 text-right">
                        @svg('tabler-user', 'w-6 h-6 text-gray-500')
                    </div>
                </div>
            </div>
        </a>
        <a class="shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-lg border bg-white bg-clip-border transition hover:border-red-600 hover:text-red-600" href="{{ route('admin.orders.index') }}">
            <div class="flex-auto p-4">
                <div class="-mx-3 flex flex-row items-center">
                    <div class="w-2/3 max-w-full flex-none px-3">
                        <div>
                            <p class="mb-0 font-sans text-base font-medium leading-normal">Đơn hàng</p>
                            <h5 class="mb-0 text-xl font-bold">
                                {{ $overview['orders'] }}
                            </h5>
                        </div>
                    </div>
                    <div class="flex basis-1/3 items-center justify-end px-3 text-right">
                        @svg('tabler-package', 'w-6 h-6 text-gray-500')
                    </div>
                </div>
            </div>
        </a>
        <a class="shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-lg border bg-white bg-clip-border transition hover:border-red-600 hover:text-red-600" href="{{ route('admin.products.index') }}">
            <div class="flex-auto p-4">
                <div class="-mx-3 flex flex-row items-center">
                    <div class="w-2/3 max-w-full flex-none px-3">
                        <div>
                            <p class="mb-0 font-sans text-base font-medium leading-normal">Sản phẩm</p>
                            <h5 class="mb-0 text-xl font-bold">
                                {{ $overview['products'] }}
                            </h5>
                        </div>
                    </div>
                    <div class="flex basis-1/3 items-center justify-end px-3 text-right">
                        @svg('tabler-pizza', 'w-6 h-6 text-gray-500')
                    </div>
                </div>
            </div>
        </a>
        <a class="shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-lg border bg-white bg-clip-border transition hover:border-red-600 hover:text-red-600" href="{{ route('admin.categories.index') }}">
            <div class="flex-auto p-4">
                <div class="-mx-3 flex flex-row items-center">
                    <div class="w-2/3 max-w-full flex-none px-3">
                        <div>
                            <p class="mb-0 font-sans text-base font-medium leading-normal">Danh mục</p>
                            <h5 class="mb-0 text-xl font-bold">
                                {{ $overview['categories'] }}
                            </h5>
                        </div>
                    </div>
                    <div class="flex basis-1/3 items-center justify-end px-3 text-right">
                        @svg('tabler-category', 'w-6 h-6 text-gray-500')
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
