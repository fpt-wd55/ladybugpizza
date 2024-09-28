@extends('layouts.client')

@section('title', 'Trang chủ')

@section('content')
    @session('success')
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endsession

    <div class="md:mx-32 lg:mx-64 min-h-screen p-4 md:p-8">

    </div>
@endsection
