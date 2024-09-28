@extends('layouts.client')

@section('title', 'Trang chủ')

@section('content')
    @session('success')
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endsession

    <div class="md:mx-32 lg:mx-64 border-black border-2 min-h-screen p-4 md:p-8">
        <div class="grid grid-cols-2">
            <div>
                day la bo loc
            </div>
            <div>
                <div></div>
                <div>
                    <p></p>
                    <div class="grid grid-cols-2">
                <div></div>
                <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
