<div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
    <div class="grid grid-cols-1 items-center justify-between pb-4">
        <div class="w-full">
            <h3 class="font-bold leading-none text-gray-900 text-lg">Top 10 đơn hàng có giá trị cao nhất</h3>
        </div>
        <div class="flex items-center justify-start w-full mt-3">
            <div class="inline-flex items-center rounded-md bg-slate-100 p-1.5">
                <button wire:click.prevent="updateTopOrder('week')"
                    class="rounded {{ $selectedTopOrder == 'Tuần' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black shadow-card hover:bg-white me-1">
                    Tuần
                </button>
                <button wire:click.prevent="updateTopOrder('month')"
                    class="rounded {{ $selectedTopOrder == 'Tháng' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                    Tháng
                </button>
                <button wire:click.prevent="updateTopOrder('year')"
                    class="rounded {{ $selectedTopOrder == 'Năm' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                    Năm
                </button>
            </div>
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
                                    <span
                                        class="text-gray-500">{{ number_format($order->amount + $order->shipping_fee - $order->discount_amount) }}₫</span>
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
