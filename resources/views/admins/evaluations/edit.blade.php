@extends('layouts.admin')
@section('title', 'Đánh Giá | Chi Tiết')
@section('content')
    {{ Breadcrumbs::render('admin.comment-products', $sanpham) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <div>

                {{-- end điểm hội viên --}}
                <div class="py-4 md:py-5 px-3">
                    <a class="product-card overflow-hidden md:flex" href="{{ route('client.product.show', $sanpham->slug) }}">
                        <img alt="" class="h-48 w-auto flex-shrink-0 object-cover  md:w-1/3" loading="lazy" src="{{ asset('storage/uploads/products/' . $sanpham->image) }}">
                        <div class="p-2 ml-3 text-sm">
                            <p class="mb-2  font-semibold text-2xl">{{$sanpham->name}}</p>
                            <div class="mb-2 flex items-center text-lg gap-1">
                                <p>{{ $sanpham->avg_rating }}</p>
                                <div class="flex items-center gap-1">
                                    @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $sanpham->avg_rating)
                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                    @else
                                        @svg('tabler-star', 'icon-sm text-red-500')
                                    @endif
                                @endfor
                                </div>
                                <p>({{ $sanpham->total_rating }})</p>
                            </div>
                            <p class="mb-4 line-clamp-3 h-12 text-base">{{ $sanpham->description }}</p>
                            <div class="bottom-4 flex items-center gap-3">
                                <p class="text-sm text-gray-500 line-through">{{ number_format($sanpham->price) }}đ</p>
                                <p class="font-semibold text-base">{{ number_format($sanpham->discount_price) }}đ</p>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- lịch sử tiêu dùng của khách hàng --}}
                <hr>
                <div class="lg:flex">
                    <div class=" p-2 md:p-8 w-full min-h-screen">
                        <h3 class="font-semibold text-lg uppercase mb-8">Lịch Sử Đánh Giá</h3>
                                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                    @forelse ($evaluations as $item)
                                    {{-- card --}}    
                                    
                                    <div class="card p-2 mb-4">
                                        <div class="mb-4 flex justify-center md:gap-1 lg:gap-4">
                                            <img alt="" class="mb-3 img-circle img-sm" loading="lazy" src="
                                            {{ filter_var($item->user->avatar, FILTER_VALIDATE_URL) ? $item->user->avatar : ($item->user->avatar ? asset('storage/uploads/avatars/' . $item->user->avatar) : asset('storage/uploads/avatars/user-default.png')) }}">
                                            <div class="">
                                                <p class="mb-1 text-sm font-medium" >{{$item->user->fullname}}</p>
                                                <div class="flex items-center gap-0.5 ">                                                  
                                                    @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $item->rating)
                                                        @svg('tabler-star-filled', 'icon-sm text-red-500')
                                                    @else
                                                        @svg('tabler-star', 'icon-sm text-red-500')
                                                    @endif
                                                @endfor
                                                </div>
                                                <p class="text-sm max-w-[270px] md:max-w-[330px] lg:max-w-[750px] break-words">{{$item->created_at->format('d-m-Y H:i')}} | 
                                                  
                                                    @foreach ($item->order->orderItems as $orderItem)
                                                    @foreach ($orderItem->productAttributes as $attribute)
                                                        @if ($attribute->product_id == $sanpham->id)  {{-- Kiểm tra product_id --}}
                                                            <span class="text-gray-900 text-xs font-normal">
                                                                {{ $attribute->attributeValue->value }}  {{-- Hiển thị giá trị attribute --}}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                <p class="text-xs max-w-[270px] md:max-w-[330px] lg:max-w-[750px] break-words">Topping : 
                                                    @foreach ($item->order->orderItems as $orderItem)
                                                    @foreach ($orderItem->toppings as $topping)
                                                    <span class="text-gray-900 text-xs font-normal">
                                                        {{ $topping->name }},
                                                    </span>    
                                                    @endforeach
                                                @endforeach
                                                </p>
                                            </div>
                                            <div class="ml-auto self-start">
                                                <div class="flex items-center justify-center">
                                                    <div
                                                        class="inline-block indicator rounded-full {{$item->status ==1 ? 'bg-green-700' : 'bg-red-700'}} ">
                                                    </div>
                                                    {{$item->status ==1 ? 'Hiển thị' : 'Ẩn'}}
                                                    <div class="px-1 py-3 flex items-center float-right">
                                                        <button id="{{$item->id}}-dropdown-button"
                                                            data-dropdown-toggle="{{$item->id}}-dropdown"
                                                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none pt-1"
                                                            type="button">
                                                            @svg('tabler-dots-vertical', 'w-5 h-5')
                                                        </button>
                                                        <div id="{{$item->id}}-dropdown"
                                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                                            <ul class="py-1 text-sm text-gray-700"
                                                                aria-labelledby="{{$item->id}}-dropdown-button">
                                                                <li class="block py-2 px-4 hover:bg-gray-100">
                                                                    <div class="flex gap-x-2 items-center">
                                                                    <p class="">Trạng Thái</p>
                                                                        <form action="{{route('admin.evaluation.updateStatus',$item->id)}}"method="POST" class="mt-1">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <label for="status-toggle-{{ $item->id }}" class="inline-flex relative items-center cursor-pointer">
                                                                                <input type="checkbox" id="status-toggle-{{ $item->id }}" name="status" class="sr-only peer"
                                                                                    value="1" {{ $item->status == 1 ? 'checked' : '' }}
                                                                                    onchange="this.form.submit()">
                                                                                <div
                                                                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none  rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                                                </div>
                                                                            </label>
                                                                        </form>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4 px-9 md:px-12 lg:px-14">
                                            <p class="mb-4 text-sm">{{$item->comment}}</p>
                                            <div class="flex flex-wrap">
                                                @foreach ($images[$item->id] as $image)
                                                <img src="{{asset('storage/uploads/evaluations/' . $image->image)}}" alt="" class="img-md mx-0.5 h-16 sm:h-20 md:h-24 object-cover rounded-sm">
                                                @endforeach
                                            </div>
                                        </div>
                                        {{-- content --}}
                                    </div>
                                    {{-- end card --}}
                                    @empty
                                    <div class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
                                        @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                        <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                                    </div>
                                    @endforelse
                                    <div class="p-4">
                                        {{ $evaluations->onEachSide(1)->links() }}
                                    </div>
                                </div>
                            </div>
                            {{-- end lịch sử tiêu dùng của khách hàng --}}
                        </div>
                    </div>
                </div>

@endsection
