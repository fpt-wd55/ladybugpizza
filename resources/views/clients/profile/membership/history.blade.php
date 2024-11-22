@extends('layouts.client')

@section('title', 'Lịch sử sử dụng điểm')

@section('content')
    <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
        <div class="lg:flex">
            @include('clients.profile.sidebar')
            <div class="card mb-8 w-full p-4 md:p-8">
                <h3 class="mb-8 font-semibold uppercase">Lịch sử sử dụng điểm</h3>
                {{-- tabs --}}
                <div class="mb-4 border-b border-gray-200 text-center text-sm font-medium text-gray-500">
                    <ul class="-mb-px flex flex-wrap">
                        <li class="me-2">
                            <a class="{{ request('tab') == 'receive' ? 'border-b-red-600 text-red-600' : '' }} inline-block rounded-t-lg border-b-2 border-transparent px-4 pb-2 hover:border-gray-300 hover:text-gray-600"
                                href="{{ route('client.profile.membership-history', ['tab' => 'receive']) }}">Lịch sử
                                nhận</a>
                        </li>
                        <li class="me-2">
                            <a class="{{ request('tab') == 'change' ? 'border-b-red-600 text-red-600' : '' }} inline-block rounded-t-lg border-b-2 border-transparent px-4 pb-2 hover:border-gray-300 hover:text-gray-600"
                                href="{{ route('client.profile.membership-history', ['tab' => 'change']) }}">Lịch sử đổi</a>
                        </li>
                    </ul>
                </div>
                {{-- history --}}

                @switch($tab)
                    @case('receive')
                        <div class="card p-4 md:p-8">
                            @forelse ($histories as $history)
                                <div class="mb-4 border-b border-gray-300">
                                    <button class="flex w-full items-center justify-between py-4">
                                        <span class="text-left text-sm font-normal">
                                            <p class="font-medium text-green-400">{{ $history->description ?? 'Nhận điểm thành công' }}</p>
                                            <p><span class="font-medium">Ngày :</span> {{ $history->created_at->format('d/m/Y') }}</p>
                                            <p><span class="font-medium">Vào lúc :</span> {{ $history->created_at->format('H:i:s') }}</p>
                                            <p></p>
                                        </span>
                                        <span class="text-green-500 transition">
                                            @svg('tabler-check')                                        
                                        </span>
                                    </button>
                                </div>
                            @empty
                                <p class="text-gray-500">Không có lịch sử nhận điểm nào.</p>
                            @endforelse
                        </div>
                    @break

                    @case('change')
                        <div class="card p-4 md:p-8">
                            @forelse ($histories as $history)
                                <div class="mb-4 border-b border-gray-300">
                                    <button class="flex w-full items-center justify-between py-4">
                                        <span class="text-left text-sm font-normal">
                                            <p class="font-medium text-green-400">{{ $history->description ?? 'Nhận điểm thành công' }}</p>
                                            <p><span class="font-medium">Ngày :</span> {{ $history->created_at->format('d/m/Y') }}</p>
                                            <p><span class="font-medium">Vào lúc :</span> {{ $history->created_at->format('H:i:s') }}</p>
                                        </span>
                                        <span class="text-green-500 transition">
                                            @svg('tabler-check')
                                        </span>
                                    </button>
                                </div>
                            @empty
                                <p class="text-gray-500">Không có lịch sử đổi điểm nào.</p>
                            @endforelse
                        </div>
                    @break

                    @default
                        <div class="text-center">
                            <p>Không tìm thấy thông tin.</p>
                        </div>
                @endswitch

            </div>
        </div>
        <div>
            {{ $histories->links()}}
        </div>
    </div>
  
@endsection
