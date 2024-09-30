@extends('layouts.client')

@section('title', 'địa chỉ')

@section('content')
<div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="lg:flex">

            @include('clients.profile.sidebar')

            <div class="card p-4 md:p-8 w-full min-h-screen">
                <h3 class="font-semibold uppercase mb-8">địa chỉ</h3>
            
                Nội dung code ở đây

            </div>
        </div>
    </div>
@endsection