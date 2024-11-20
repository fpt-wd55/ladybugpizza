@extends('layouts.client')

@section('title', 'Chi tiết combo')

@section('content')
    <form action="}" method="post">
        @method('POST')
        @csrf
        <div class="min-h-screen p-4 transition md:p-4 lg:mx-32">

            {{-- Product detail --}}
            <div class="no-scrollbar flex w-full items-center gap-4 overflow-x-auto">

                <a class="product-card relative flex w-full flex-shrink-0 overflow-hidden " href="">
                    <img alt="" class="h-60 w-1/2 flex-shrink-0 object-cover" loading="lazy"
                        src="{{ asset('storage/uploads/combos/' . $combo->image) }}"
                        onerror="this.src='{{ asset('storage/uploads/products/product-placehoder.jpg') }}'"
                                        class="w-8 h-8 mr-3 rounded bg-slate-400 object-cover">
                    <div class="p-4">
                        <p class="mb-2 text-sm font-semibold md:text-base">{{ $combo->name }}</p>
                        <ul class="list-disc space-y-1 ps-4 text-xs md:text-sm">
                            @foreach ($combo->comboDetails as $detail)
                                <li>
                                    {{ $detail->productAttribute->product->name }} -
                                    {{ $detail->productAttribute->attributeValue->value }}
                                </li>
                            @endforeach
                        </ul>
                        <div class="absolute bottom-4 flex items-center gap-2">
                            <p class="text-sm text-gray-500 line-through">{{ number_format($combo->discount_price) }} đ</p>
                            <p class="text-lg font-semibold">{{ number_format($combo->price) }} đ</p>
                        </div>
                    </div>
                </a>

            </div>

            <div class="mt-10">
                <p class="inline-block uppercase rounded-t-lg mb-3 pb-1 border-b-2 border-[#D30A0A] text-[#D30A0A]">chi tiết
                    combo</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($groupedComboDetails as $detail)
                        <div class="product-card flex h-[100px] bg-white shadow-md rounded-lg overflow-hidden">
                            <img alt="Bánh mì ăn liền" class="w-1/3 h-full object-cover" loading="lazy"
                                src="{{ asset('storage/uploads/products/' . $detail->productAttribute->product->image) }}">
                            <div class="p-2 flex flex-col justify-between flex-grow text-sm">
                                <p class="font-semibold">{{ $detail->productAttribute->product->name }}</p>
                                <div class="hidden md:block">
                                    <p
                                        class="{{ empty($detail->productAttribute->product->description) ? 'min-h-12' : '' }} text-xs line-clamp-2">
                                        {{ $detail->productAttribute->product->description }}
                                    </p>
                                </div>
                                <span title="số lượng"
                                    class="text-[#D30A0A] font-medium self-end">x{{ $detail->quantity }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        </div>
        {{-- Add to card bar --}}
        <div class="sticky bottom-16 w-full border-t bg-white p-4 transition lg:bottom-0 lg:px-32">
            <div class="flex items-center justify-between">
                <div class="inline-flex rounded-md shadow-sm" role="group">
                </div>

                <div class="flex items-center justify-center gap-4">
                    <p class="text-sm line-through">{{ number_format($combo->discount_price) }} đ</p>
                    <p class="text-lg font-semibold">{{ number_format($combo->price) }} đ</p>
                </div>

                <div class="flex items-center justify-end gap-2">

                    <button class="button-red" type="submit">
                        @svg('tabler-shopping-bag-plus', 'md:me-2 icon-sm')
                        <span class="hidden md:block">Thêm vào giỏ hàng</span>
                    </button>
                </div>
            </div>
        </div>
    </form>


@endsection
