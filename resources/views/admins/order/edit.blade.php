@extends('layouts.admin')
@section('title', 'Danh sách đơn hàng')

@section('content')
    {{ Breadcrumbs::render('admin.orders.edit') }}
    <div class="container mx-auto p-6">
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
                    <p class="mb-8">{{$order->created_at}}</p>
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
                        <div class="flex justify-start gap-2 mt-10">
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
                </div>
            </div>
    </div>
@endsection
