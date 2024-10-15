@extends('layouts.admin')
@section('title', 'Điểm thành viên | chi tiết')
@section('content')
    {{ Breadcrumbs::render('admin.memberships.edit', $membership) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <div>
                
                {{-- end điểm hội viên --}}
                <div class="py-4 md:py-5 px-3">
                    <div class="grid gap-4 md:grid-cols-2 sm:gap-8 lg:gap-16">
                        <div class="space-y-4">
                            <div class="flex space-x-4">
                                <img loading="lazy" class=" img-circle w-20 h-20 mr-3 rounded"
                                    src="{{ asset('storage/uploads/avatars/' . $membership->user->avatar) }}" alt="Avatar"
                                    {{ Auth::user()->avatar() }} />
                                <div>
                                    <div class="flex ms-2">
                                        <span
                                            class="flex items-center {{ $membership->user->status == 1 ? 'text-green-500' : 'text-red-500' }}">@svg('tabler-circle-filled', 'w-3 h-3')</span>
                                        <span
                                            class="inline-block rounded bg-primary-100 px-1 text-xs font-medium text-primary-800 ">
                                            {{ $membership->user->username }}
                                        </span>
                                    </div>
                                    <h2
                                        class="flex items-center text-xl font-bold ms-2 mt-2 leading-none text-gray-900  sm:text-2xl">
                                        {{ $membership->user->fullname }} </h2>
                                </div>
                            </div>
                            <div class="flex gap-x-1">
                                <a href="{{ route('admin.memberships.index') }}"
                                    class=" button-dark">
                                    @svg('tabler-arrow-back-up', 'h-5 w-5 text-white me-2')
                                    Quay lại
                                </a>
                                <a href="{{ route('admin.users.show', $membership->user_id) }}"
                                    class="button-red">
                                    @svg('tabler-user-edit', 'h-5 w-5 text-white me-2')
                                    Thông tin khách hàng
                                </a>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 gap-1 ">
                                <h3 class="font-semibold uppercase mb-4 pl-2">Điểm hội viên</h3>
                                {{-- Điểm hội viên --}}
                                <div class="flex flex-col md:flex-row items-center gap-4">
                                    <img loading="lazy" src="{{ asset('storage/uploads/ranks/' . $img) }}" alt="" class="img-md md:img-sm">
                                    <div class="w-full mx-1">
                                        <div class="flex items-center justify-between mb-1 px-1 ">
                                            <p
                                                class="uppercase font-bold  
                                                @php
                                                   switch ($rank) {
                                                        case 'Đồng':
                                                            echo ' text-[#C67746]'; 
                                                            break;
                                                        case 'Bạc':
                                                            echo 'text-gray-500';
                                                            break;
                                                        case 'Vàng':
                                                            echo 'text-yellow-300';
                                                            break;
                                                        case 'Kim Cương':
                                                            echo 'text-blue-400';
                                                            break;
                                                        default:
                                                            echo 'text-gray-100'; 
                                                            break;
                                                                 } 
                                                @endphp ">{{ $rank }}</p>
                                            <p class="text-sm font-medium">{{ $membership->points }} Điểm</p>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                            <div class="
                                             @php
                                            switch ($rank) {
                                                case 'Đồng':
                                                    echo ' bg-[#C67746]'; 
                                                    break;
                                                case 'Bạc':
                                                    echo 'bg-gray-500'; 
                                                    break;
                                                case 'Vàng':
                                                    echo 'bg-yellow-300'; 
                                                    break;
                                                case 'Kim Cương':
                                                    echo 'bg-blue-400'; 
                                                    break;
                                                default:
                                                    echo 'bg-gray-100'; 
                                                    break;
                                                          }
                                                @endphp h-2 rounded-full"
                                                style="width:{{ $progress }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    
                </div>
                {{-- lịch sử tiêu dùng của khách hàng --}}
                <hr>
                    <div class="lg:flex">
                        <div class=" p-4 md:p-8 w-full min-h-screen">
                            <h3 class="font-semibold text-lg uppercase mb-8">Lịch Sử </h3>
                            {{-- tabs --}}
                            <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 mb-4">
                                <ul class="flex flex-wrap -mb-px">
                                    <li class="me-2">
                                        <a href="#"
                                            class="inline-block px-4 pb-2 text-red-600 border-b-2 border-red-600 rounded-t-lg"
                                            aria-current="page">Tất cả lịch sử</a>
                                    </li>
                                    <li class="me-2">
                                        <a href="#"
                                            class="inline-block px-4 pb-2 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                                            Đã nhận</a>
                                    </li>
                                    <li class="me-2">
                                        <a href="#"
                                            class="inline-block px-4 pb-2 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                                            Đã dùng</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="product-card p-4 flex items-center justify-between">
                                        <div class="text-sm space-y-2">
                                            <p class="font-medium">
                                                <span class="uppercase me-2">AOHDJRNF</span>
                                                <span class="badge-yellow inline-flex items-center">450 @svg('tabler-coins', 'icon-sm ms-2')</span>
                                            </p>
                                            <p>Giảm 20% cho đơn tối thiểu 300,000đ</p>
                                            <p>Thời Gian :<span class="font-medium"> 25-07-2024</span></p>
                                        </div>
                                        <div>
                                           <p class="text-[#D30A0A] text-lg font-semibold">+100</p>
                                        </div>
                                    </div>
                                @endfor
                            
                        </div>
                    </div>
                {{-- end lịch sử tiêu dùng của khách hàng --}}
            </div>
        </div>
    </div>
@endsection