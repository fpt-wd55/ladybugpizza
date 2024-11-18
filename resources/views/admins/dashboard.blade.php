@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.dashboard') }}

    {{-- Tổng quan --}}
    {{-- @livewire('overview') --}}

    {{-- Thống kê --}}
    {{-- <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Doanh thu</h3> --}}
    {{-- Thống kê doanh thu; đơn hàng tổng --}}
    @livewire('statistic-revenue-one')
    {{-- Thống kê đơn hàng theo danh mục; top 10 đơn hàng cao nhất --}}
    {{-- @livewire('statistic-order-one') --}}
    {{-- Thống kê tỷ lệ thanh toán đơn hàng; top 10 khu vực đặt hàng nhiều nhất --}}
    {{-- <div class="grid w-full grid-cols-1 gap-4 xl:grid-cols-2">
        @livewire('statistic-order-two')
        @livewire('statistic-order-three')
    </div> --}}
    {{-- <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Sản phẩm</h3> --}}
    {{-- Thống kê số sản phẩm theo danh mục, top sản phẩm theo các tiêu chí --}}
    {{-- <div class="grid w-full grid-cols-1 gap-4 xl:grid-cols-2">
        @livewire('statistic-product-one')
        @livewire('statistic-product-two')
    </div> --}}
    <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Người dùng</h3>
    <div class="grid w-full grid-cols-1 gap-4 xl:grid-cols-2">
        @livewire('statistic-product-one')
        @livewire('statistic-product-two')
    </div>
    {{-- @livewire('statistic') --}}
@endsection
@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endsection
