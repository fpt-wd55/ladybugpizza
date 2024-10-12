@extends('layouts.admin')
@section('title', 'Điểm thành viên | chi tiết')
@section('content')
    {{ Breadcrumbs::render('admin.memberships.edit', $membership) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <div>
                <div class="grid grid-cols-1 gap-2 border-b border-gray-200 py-3  ">
                    <h3 class="font-semibold uppercase mb-4 pl-2">Điểm hội viên</h3>
                    {{-- Điểm hội viên --}}
                    <div class="flex flex-col md:flex-row items-center gap-8 mb-5">
                        <img loading="lazy" src="{{ asset('storage/uploads/ranks/' . $img) }}" alt="" class="img-md">
                        <div class="w-full mx-1">
                            <div class="flex items-center justify-between mb-1 px-1 ">
                                <p
                                    class="uppercase font-bold  
                                    @php
                                       switch ($rank) {
                                            case 'Đồng':
                                                echo ' text-[#C67746]'; // màu chữ nâu và nền vàng nhạt
                                                break;
                                            case 'Bạc':
                                                echo 'text-gray-500'; // màu chữ xám và nền xanh nhạt
                                                break;
                                            case 'Vàng':
                                                echo 'text-yellow-300'; // màu chữ vàng đậm và nền vàng nhạt
                                                break;
                                            case 'Kim Cương':
                                                echo 'text-blue-400'; // màu chữ xanh đậm và nền xanh nhạt
                                                break;
                                            default:
                                                echo 'text-gray-100'; // mặc định
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
                                        echo ' bg-[#C67746]'; // màu chữ nâu và nền vàng nhạt
                                        break;
                                    case 'Bạc':
                                        echo 'bg-gray-500'; // màu chữ xám và nền xanh nhạt
                                        break;
                                    case 'Vàng':
                                        echo 'bg-yellow-300'; // màu chữ vàng đậm và nền vàng nhạt
                                        break;
                                    case 'Kim Cương':
                                        echo 'bg-blue-400'; // màu chữ xanh đậm và nền xanh nhạt
                                        break;
                                    default:
                                        echo 'bg-gray-100'; // mặc định
                                        break;
                                              }
                                    @endphp h-2 rounded-full"
                                    style="width:{{ $progress }}%"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="py-4 md:py-8 px-3">
                    <div class="mb-4 grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
                        <div class="space-y-4">
                            <div class="flex space-x-4">
                                <img loading="lazy" class=" img-circle w-20 h-20 mr-3 rounded"
                                    src="{{ asset('storage/uploads/avatars/' . $membership->user->avatar) }}" alt="Avatar"
                                    {{ Auth::user()->avatar() }} />
                                <div>
                                    <div class="flex ms-2">
                                        <span
                                            class="flex items-center {{ $membership->status == 1 ? 'text-green-500' : 'text-red-500' }}">@svg('tabler-circle-filled', 'w-3 h-3')</span>
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
                            <dl class="">
                                <dt class="font-semibold text-gray-900 ">Email</dt>
                                <dd class="text-gray-500 ">{{ $membership->user->email }}</dd>
                            </dl>
                            <dl>
                                <dt class="font-semibold text-gray-900 ">Trạng thái</dt>
                                <dd class="text-gray-500 flex items-center py-1">
                                    <form action="{{ route('admin.memberships.updateStatus', $membership) }}"
                                        method="POST">
                                        @csrf
                                        <label for="status-toggle" class="inline-flex relative items-center cursor-pointer">
                                            <input type="checkbox" id="status-toggle" name="status" class="sr-only peer"
                                                value="1" {{ $membership->status == 1 ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            <div
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none  rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                            </div>
                                        </label>
                                    </form>
                                </dd>
                            </dl>

                        </div>
                        <div class="space-y-4">
                            <dl>
                                <dt class="font-semibold text-gray-900 ">Số điện thoại</dt>
                                <dd class="text-gray-500 ">{{ $membership->user->phone }}</dd>
                            </dl>
                            <dl>
                                <dt class="font-semibold text-gray-900 ">Ngày sinh</dt>
                                <dd class="text-gray-500 ">{{ $membership->user->date_of_birth }}</dd>
                            </dl>
                            <dl>
                                <dt class="font-semibold text-gray-900 ">Giới tính</dt>
                                <dd class="text-gray-500 ">
                                    @if ($membership->user->gender == 1)
                                        Nam
                                    @elseif ($membership->user->gender == 2)
                                        Nữ
                                    @else
                                        Khác
                                    @endif
                                </dd>
                            </dl>
                            <dl>
                                <dt class="font-semibold text-gray-900">Thứ hạng</dt>
                                <dd
                                    class="me-2 mt-1.5 inline-flex shrink-0 items-center rounded px-5 py-1 text-xs font-medium 
                                    @php
                                        switch ($rank) {
                                            case 'Đồng':
                                                echo 'text-[#3B3030] bg-[#C67746]'; // màu chữ nâu và nền vàng nhạt
                                                break;
                                            case 'Bạc':
                                                echo 'text-gray-700 bg-[#DFE1DE]'; // màu chữ xám và nền xanh nhạt
                                                break;
                                            case 'Vàng':
                                                echo 'text-yellow-700 bg-yellow-300'; // màu chữ vàng đậm và nền vàng nhạt
                                                break;
                                            case 'Kim Cương':
                                                echo 'text-blue-700 bg-blue-200'; // màu chữ xanh đậm và nền xanh nhạt
                                                break;
                                            default:
                                                echo 'text-gray-500 bg-gray-100'; // mặc định
                                                break;
                                                     } 
                                        @endphp">
                                    {{ $rank }}
                                </dd>
                            </dl>


                        </div>
                    </div>
                    <a href="{{ route('admin.memberships.index') }}"
                        class=" inline-flex w-full items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-0 sm:w-auto">
                        @svg('tabler-arrow-back-up', 'h-5 w-5 text-white me-2')
                        Quay lại
                    </a>
                    
                    <a href="{{ route('admin.users.show', $membership->user_id) }}"
                        class=" inline-flex w-full items-center justify-center rounded-lg bg-[#D30A0A] px-5 py-2.5 text-sm font-medium text-white hover:bg-[#AF0808] focus:ring-0 sm:w-auto">
                        @svg('tabler-user-edit', 'h-5 w-5 text-white me-2')
                        Thông tin khách hàng
                    </a>

                </div>

            </div>
        </div>
    </div>
@endsection
