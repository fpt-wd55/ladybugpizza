<div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
    <div class="grid grid-cols-1 items-center justify-between pb-4 space-y-3 md:space-y-0 md:space-x-4">
        <div class="w-full">
            <div class="grid grid-cols-1 lg:grid-cols-3 items-center justify-between pb-4">
                <div class="w-full col-span-2">
                    <div class="flex items-center w-full space-x-3 md:w-auto">
                        <button id="dropdownTopUserLink" data-dropdown-toggle="dropdownTopUser"
                            data-dropdown-placement="bottom-start"
                            class="flex items-center justify-start w-full py-2 text-lg font-bold text-gray-900 md:w-auto focus:outline-none hover:text-slate-600 focus:z-10 focus:ring-0">
                            {{ $nameSelectedTopUser }}
                            @svg ('tabler-chevron-down', 'w-4 h-4 ml-2 text-gray-500')
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownTopUser"
                            class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-80">
                            <ul class="py-2 text-sm text-gray-700">
                                <li>
                                    <a href="#" wire:click.prevent="updateSelectionUser('user', 'mostOrder')"
                                        class="block px-4 py-2 hover:bg-gray-100">Top người dùng mua hàng nhiều nhất</a>
                                </li>
                                <li>
                                    <a href="#" wire:click.prevent="updateSelectionUser('user', 'mostPoint')"
                                        class="block px-4 py-2 hover:bg-gray-100">Top người dùng có điểm tích lũy cao
                                        nhất</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-start lg:justify-end w-full md:w-auto mt-3 lg:m-0">
                    <div class="inline-flex items-center rounded-md bg-slate-100 p-1.5">
                        <button wire:click.prevent="updateSelectionUser('time', 'week')"
                            class="rounded {{ $selectedTimeTopUser == 'week' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                            Tuần
                        </button>
                        <button wire:click.prevent="updateSelectionUser('time', 'month')"
                            class="rounded {{ $selectedTimeTopUser == 'month' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                            Tháng
                        </button>
                        <button wire:click.prevent="updateSelectionUser('time', 'year')"
                            class="rounded {{ $selectedTimeTopUser == 'year' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
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
                @forelse ($topUsers as $user)
                    <li class="py-2">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center py-1 text-gray-900 whitespace-nowrap shrink-0">
                                <a class="shrink-0" data-fslightbox="gallery" href="{{ $user->avatar() }}">
                                    <img loading="lazy" src="{{ $user->avatar() }}" alt="Avatar"
                                        class="w-8 h-8 mr-3 rounded object-cover">
                                </a>
                                <a href="{{ route('admin.users.show', $user) }}">
                                    <div class="grid grid-flow-row">
                                        <span class="text-sm">{{ $user->username }}</span>
                                        <span class="text-sm text-gray-500">{{ $user->email }}</span>
                                    </div>
                                </a>
                            </div>
                            <div class="inline-flex items-center font-semibold text-gray-900">
                                <a href="{{ route('admin.users.show', $user) }}"
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
