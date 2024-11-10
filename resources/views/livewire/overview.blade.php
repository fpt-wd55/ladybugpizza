<div>
    <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Tổng quan</h3>
    <div class="my-4 grid w-full grid-cols-2 gap-4 2xl:grid-cols-4">
        <div class="relative flex flex-col min-w-0 border break-words bg-white shadow-soft-xl rounded-lg bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3 items-center">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-lg">Tài khoản</p>
                            <h5 class="mb-0 font-bold text-base">
                                {{ $overview['users'] }}
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3 flex items-center justify-end">
                        @svg('tabler-user', 'w-8 h-8 text-gray-500')
                    </div>
                </div>
            </div>
        </div>
        <div class="relative flex flex-col min-w-0 border break-words bg-white shadow-soft-xl rounded-lg bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3 items-center">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-lg">Đơn hàng</p>
                            <h5 class="mb-0 font-bold text-base">
                                {{ $overview['orders'] }}
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3 flex items-center justify-end">
                        @svg('tabler-package', 'w-8 h-8 text-gray-500')
                    </div>
                </div>
            </div>
        </div>
        <div
            class="relative flex flex-col min-w-0 border break-words bg-white shadow-soft-xl rounded-lg bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3 items-center">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-lg">Sản phẩm</p>
                            <h5 class="mb-0 font-bold text-base">
                                {{ $overview['products'] }}
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3 flex items-center justify-end">
                        @svg('tabler-pizza', 'w-8 h-8 text-gray-500')
                    </div>
                </div>
            </div>
        </div>
        <div
            class="relative flex flex-col min-w-0 border break-words bg-white shadow-soft-xl rounded-lg bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3 items-center">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-lg">Danh mục</p>
                            <h5 class="mb-0 font-bold text-base">
                                {{ $overview['categories'] }}
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3 flex items-center justify-end">
                        @svg('tabler-category', 'w-8 h-8 text-gray-500')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
