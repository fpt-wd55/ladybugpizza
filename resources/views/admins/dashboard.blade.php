@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.dashboard') }}

    {{-- Tổng quan --}}
    {{-- @livewire('overview') --}}

    {{-- Thống kê --}}
    <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Doanh thu</h3>
    {{-- Thống kê doanh thu; đơn hàng tổng --}}
    @livewire('statistic-revenue-one')
    {{-- Thống kê đơn hàng theo danh mục; top 10 đơn hàng cao nhất --}}
    @livewire('statistic-order-one')
    {{-- Thống kê doanh thu theo sản phẩm --}}

    @livewire('statistic')
@endsection
@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endsection
