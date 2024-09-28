@extends('layouts.client')

@section('title', 'Trang chủ')

@section('content')
    @session('success')
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endsession
@endsection
