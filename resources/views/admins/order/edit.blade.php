@extends('layouts.admin')
@section('title', 'Cập nhật đơn hàng')

@section('content')
    {{ Breadcrumbs::render('admin.orders.edit') }}
    <div class="container mx-auto p-6 ml-4">
                <h1 class="text-2xl font-semibold mb-4">Đặt hàng</h1>
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="grid grid-cols-3 gap-4">
                {{-- item1 --}}
                <div>
                    <h2 class="text-lg font-semibold mb-4">Tổng quan</h2>
                    <label class="font-semibold">Ngày tạo</label>
                    <p class="mb-4">{{$order->created_at}}</p>
                    <label class="font-semibold">Tổng tiền</label>
                    <p class="mb-4">{{number_format($order->amount)}}đ</p>
                    <label class="font-semibold">Phí giao hàng</label>
                    <p class="mb-4">{{number_format($order->shipping_fee)}}đ</p>
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="w-[80%]">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="status" class="block mb-2 font-semibold">Trạng thái</label>
                            <select class="select" name="status" id="status" class="border-gray-300 rounded w-full p-2">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" 
                                        {{ $order->orderStatus->name === $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>     
                        <div class="flex justify-start gap-2 mt-6">
                            <button type="submit" class="button-green">Cập nhật</button>          
                            <a href="{{route('admin.orders.index')}}" class="button-blue">Quay lại</a>   
                        </div>    
                    </form>
                </div>
                {{-- item2 --}}
                <div>
                    <h3 class="text-lg font-semibold mb-2">Thanh toán</h3>
                    <p>{{$order->user->fullname}}</p>
                    <p>{{$order->address->detail_address}}</p>
                    <p class="mb-2">{{$order->address->ward}}, {{$order->address->district}}, {{$order->address->province}}</p>                 
                    <label class="font-semibold">Địa chỉ email</label>
                    <p class="mb-2">{{$order->user->email}}</p>
                    <label class="font-semibold">Số điện thoại</label>
                    <p>{{$order->user->phone}}</p>
                    
                </div>
                {{-- item3 --}}
                <div>
                    <h4 class="text-lg font-semibold mb-2">Giao hàng</h4>
                    <p>{{$order->user->fullname}}</p>
                    <p>{{$order->address->detail_address}}</p>
                    <p class="mb-2">{{$order->address->ward}}, {{$order->address->district}}, {{$order->address->province}}</p>
                    <label class="font-semibold">Ghi chú</label>
                    <p class="mb-2">{{$order->notes}}</p>
                </div>
                 {{-- SẢN PHẨM --}}
                {{-- <div class="flex justify-between">
                    <div> --}}
                        {{-- sản phẩm --}}
                        {{-- <div class="pl-4 ">
                            <label class="font-semibold">Sản phẩm</label> <br>
                            @foreach ($order->orderItems as $orderItem)
                                @foreach ($orderItem->productAttributes as $products)
                                    <span class="text-gray-800 font-semibold">
                                        {{ $products->product->name }} ,
                                    </span>
                                @endforeach
                            @endforeach
                        </div> --}}
                        {{-- thuộc tính --}}
                        {{-- <div class="pl-4 ">
                            <span>Đế : </span>
                            @foreach ($order->orderItems as $orderItem)
                                @foreach ($orderItem->productAttributes as $attribute)
                                    {{ $attribute->attributeValue->value }}
                                @endforeach
                            @endforeach
                        </div> --}}
                        {{-- topping --}}
                        {{-- <div class="pl-4 ">
                            <span>Topping : </span>
                            @foreach ($order->orderItems as $orderItem)
                                @foreach ($orderItem->toppings as $topping)
                                    {{ $topping->name }}
                                @endforeach
                            @endforeach
                        </div> --}}
                    {{-- </div>
                    <div>
                        <label class="font-semibold">Tổng tiền</label>
                        <p>{{ number_format($order->amount) }}đ</p>
                    </div>
                </div> --}}
            </div>
    </div>
@endsection
