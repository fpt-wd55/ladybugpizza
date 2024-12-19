<div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
    <div class="grid grid-cols-1 items-center justify-between pb-4 space-y-3 md:space-y-0 md:space-x-4">
        <div class="w-full">
            <div class="grid grid-cols-1 items-center justify-between pb-4">
                <div class="w-full">
                    <div class="flex items-center w-full space-x-3 md:w-auto">
                        <button id="dropdownTopProductLink" data-dropdown-toggle="dropdownTopProduct"
                            data-dropdown-placement="bottom-start"
                            class="flex items-center justify-start w-full text-lg font-bold text-gray-900 md:w-auto focus:outline-none hover:text-slate-600 focus:z-10 focus:ring-0">
                            {{ $nameSelectedTopProduct }}
                            @svg ('tabler-chevron-down', 'w-4 h-4 ml-2 text-gray-500')
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownTopProduct"
                            class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-80">
                            <ul class="py-2 text-sm text-gray-700">
                                <li>
                                    <a href="#" wire:click.prevent="updateSelection('product', 'mostPurchased')"
                                        class="block px-4 py-2 hover:bg-gray-100">Sản phẩm có lượt mua nhiều nhất</a>
                                </li>
                                <li>
                                    <a href="#" wire:click.prevent="updateSelection('product', 'mostReviewed')"
                                        class="block px-4 py-2 hover:bg-gray-100">Sản phẩm có <strong>lượt</strong> đánh
                                        giá cao nhất</a>
                                </li>
                                <li>
                                    <a href="#" wire:click.prevent="updateSelection('product', 'highestQuality')"
                                        class="block px-4 py-2 hover:bg-gray-100">Sản phẩm có <strong>chất
                                            lượng</strong> đánh giá cao nhất</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-start w-full mt-3">
                    <div class="inline-flex items-center rounded-md bg-slate-100 p-1.5">
                        <button wire:click.prevent="updateSelection('time', 'day')"
                            class="rounded {{ $selectedTimeTopProduct == 'day' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black shadow-card hover:bg-white me-1">
                            Ngày
                        </button>
                        <button wire:click.prevent="updateSelection('time', 'week')"
                            class="rounded {{ $selectedTimeTopProduct == 'week' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                            Tuần
                        </button>
                        <button wire:click.prevent="updateSelection('time', 'month')"
                            class="rounded {{ $selectedTimeTopProduct == 'month' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                            Tháng
                        </button>
                        <button wire:click.prevent="updateSelection('time', 'year')"
                            class="rounded {{ $selectedTimeTopProduct == 'year' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                            Năm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="border-t border-gray-200 overflow-y-auto no-scrollbar h-96">
        <div>
            <ul class="divide-y divide-gray-200">
                @forelse ($topProducts as $product)
                    <li class="py-2">
                        <div class="flex items-center justify-between">
                            <div class="flex min-w-0 items-center shrink-0">
                                <a class="shrink-0" data-fslightbox="gallery"
                                    href="{{ asset('storage/uploads/products/' . $product->image) }}">
                                    <img loading="lazy" src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                        onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'"
                                        class="w-8 h-8 mr-3 rounded bg-slate-400 object-cover">
                                </a>
                                <div class="grid grid-flow-row">
                                    <span class="text-sm">{{ $product->name }}</span>
                                    <div class="flex items-center gap-1">
                                        <p>{{ round($product->avg_rating, 1) }}</p>
                                        <div class="flex items-center gap-0.3">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $product->avg_rating)
                                                    @svg('tabler-star-filled', 'icon-sm text-red-500')
                                                @else
                                                    @svg('tabler-star', 'icon-sm text-red-500')
                                                @endif
                                            @endfor
                                        </div>
                                        <p>({{ $product->total_rating }})</p>
                                    </div>
                                </div>
                            </div>
                            <div class="inline-flex items-center font-semibold text-gray-900">
                                <a href="{{ route('admin.products.edit', $product) }}"
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
