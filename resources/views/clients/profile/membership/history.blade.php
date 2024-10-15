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
                            <a aria-current="page" class="inline-block rounded-t-lg border-b-2 border-red-600 px-4 pb-2 text-red-600" href="{{ route('client.profile.membership-history', ['tab' => 'all']) }}">Tất cả</a>
                        </li>
                        <li class="me-2">
                            <a class="inline-block rounded-t-lg border-b-2 border-transparent px-4 pb-2 hover:border-gray-300 hover:text-gray-600" href="{{ route('client.profile.membership-history', ['tab' => 'receive']) }}">Lịch sử nhận</a>
                        </li>
                        <li class="me-2">
                            <a class="inline-block rounded-t-lg border-b-2 border-transparent px-4 pb-2 hover:border-gray-300 hover:text-gray-600" href="{{ route('client.profile.membership-history', ['tab' => 'change']) }}">Lịch sử đổi</a>
                        </li>
                    </ul>
                </div>

                {{-- history --}}
                Nội dung code ở đây
            </div>
        </div>
    </div>
@endsection
