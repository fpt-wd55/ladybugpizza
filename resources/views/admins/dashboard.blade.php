@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.dashboard') }}
    
    {{-- Tổng quan --}}
    @livewire('overview')

    {{-- Thống kê --}}
    @livewire('statistic')
@endsection
