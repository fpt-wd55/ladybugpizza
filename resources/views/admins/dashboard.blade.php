@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.dashboard') }}

    {{-- Tổng quan --}}
    @livewire('overview')

    {{-- Thống kê --}}
    <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Doanh thu</h3>
    {{-- Doanh thu và đơn hàng --}}
    @livewire('statistic-revenue-one')
@endsection
@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endsection
