<div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
    <div class="grid grid-cols-2 items-center justify-between pb-4 space-y-3 md:space-y-0 md:space-x-4">
        <div class="w-full">
            <div class="flex items-center w-full space-x-3 md:w-auto">
                <button id="dropdownTopProductLink" data-dropdown-toggle="dropdownTopProduct"
                    data-dropdown-placement="bottom-start"
                    class="flex items-center justify-start w-full py-2 text-lg font-bold text-gray-900 md:w-auto focus:outline-none hover:text-slate-600 focus:z-10 focus:ring-0">
                    {{ $selectedTopProduct }}
                    @svg ('tabler-chevron-down', 'w-4 h-4 ml-2 text-gray-500')
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownTopProduct"
                    class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-72">
                    <ul class="py-2 text-sm text-gray-700">
                        <li>
                            <a href="#" wire:click.prevent="updateTopProduct('mostPurchased')"
                                class="block px-4 py-2 hover:bg-gray-100">Sản phẩm có lượt mua nhiều nhất</a>
                        </li>
                        <li>
                            <a href="#" wire:click.prevent="updateTopProduct('mostInStock')"
                                class="block px-4 py-2 hover:bg-gray-100">Sản phẩm tồn kho nhiều nhất</a>
                        </li>
                        <li>
                            <a href="#" wire:click.prevent="updateTopProduct('mostReviewed')"
                                class="block px-4 py-2 hover:bg-gray-100">Sản phẩm có lượt đánh giá cao nhất</a>
                        </li>
                        <li>
                            <a href="#" wire:click.prevent="updateTopProduct('highestQuality')"
                                class="block px-4 py-2 hover:bg-gray-100">Sản phẩm có chất lượng đánh giá cao nhất</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div
            class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">

        </div>
    </div>
    <div class="border-t border-gray-200 overflow-y-auto no-scrollbar h-96">
        <div>
            <ul class="divide-y divide-gray-200">
                @forelse ($topOrders as $order)
                    <li class="py-2">
                        <div class="flex items-center justify-between">
                            <div class="flex min-w-0 items-center">
                                <div>
                                    <p class="truncate font-medium text-gray-900">
                                        Mã đơn hàng: #{{ $order->id }}
                                    </p>
                                    <span class="text-gray-500">{{ number_format($order->amount) }}₫</span>
                                </div>
                            </div>
                            <div class="inline-flex items-center font-semibold text-gray-900">
                                <a href="{{ route('admin.orders.edit', $order) }}"
                                    class="flex w-full items-center justify-center text-sm font-medium text-gray-900 hover:text-slate-600 focus:z-10 focus:ring-0 md:w-auto">
                                    @svg('tabler-external-link', 'h-4 w-4 me-1.5')
                                    Chi tiết
                                </a>
                            </div>
                        </div>
                    </li>
                @empty
                    <dl class="w-1/2 sm:w-1/4 sm:flex-1 lg:w-auto">
                        <div class="flex flex-col items-center justify-center p-6 rounded-lg w-full h-80">
                            @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                            <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                        </div>
                    </dl>
                @endforelse
            </ul>
        </div>
    </div>
</div>
