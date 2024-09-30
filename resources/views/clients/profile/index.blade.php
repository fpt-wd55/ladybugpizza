@extends('layouts.client')

@section('title', 'Tài khoản và bảo mật')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="lg:flex">
            @include('clients.profile.sidebar')
            
            <div class="card p-4 md:p-8 w-full min-h-screen">
                <h3 class="font-semibold uppercase mb-8">hồ sơ của tôi</h3>
                <div class="grid grid-cols-1 lg:grid-cols-3">
                    <div class="col-span-1 flex flex-col items-center justify-center gap-4">
                        <img class="img-circle img-lg"
                            src="{{ filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL) ? Auth::user()->avatar : asset('storage/uploads/avatars/' . (Auth::user()->avatar ?? 'user-default.png')) }}"
                            alt="">
                        <button class="button-red">Chọn ảnh</button>
                    </div>
                    <div class="col-span-2">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
