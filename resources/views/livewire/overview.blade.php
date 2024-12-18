<div>
    <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Tổng quan</h3>
    <div class="my-4 grid w-full grid-cols-2 gap-4 lg:grid-cols-3 2xl:grid-cols-4">
        @foreach ($overview as $item)
            <a class="shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-lg border bg-white bg-clip-border text-gray-700 transition hover:border-red-600 hover:text-red-600" href="{{ $item['route'] }}">
                <div class="flex-auto p-4">
                    <div class="-mx-3 flex flex-row items-center">
                        <div class="w-2/3 max-w-full flex-none px-3">
                            <div>
                                <p class="mb-0 font-sans text-base font-medium leading-normal">{{ $item['label'] }}</p>
                                <h5 class="mb-0 text-xl font-bold">
                                    {{ $item['count'] }}
                                </h5>
                            </div>
                        </div>
                        <div class="flex basis-1/3 items-center justify-end px-3 text-right">
                            @svg($item['icon'], 'w-6 h-6')
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
