@extends('layouts.client')

@section('title', 'Địa chỉ')

@section('content')
    <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
        <div class="lg:flex">

            @include('clients.profile.sidebar')

            <div class="card flex min-h-screen w-full flex-col p-4 md:p-8">
                <div class="mb-8 flex items-start justify-between">
                    <h3 class="font-semibold uppercase">địa chỉ</h3>
                    <a class="button-red" href="{{ route('client.profile.add-location') }}">
                        @svg('tabler-plus', 'icon-md me-2')
                        Thêm địa chỉ
                    </a>
                </div>

                <div class="flex-grow">
                    @foreach ($addresses as $address)
                        <div class="card mb-4 flex justify-between p-4">
                            <div>
                                <div class="mb-2 flex items-center gap-4">
                                    <p class="font-medium">{{ $address->title }}</p>
                                    @if ($address->is_default == 1)
                                        <span class="badge-red">Mặc định</span>
                                    @endif
                                </div>
                                <div class="mb-2 text-sm">
                                    <p class="line-clamp-2">
                                        {{ $address->detail_address }} <br>
                                        {{ $address->ward->name_with_type }},
                                        {{ $address->district->name_with_type }}, {{ $address->province->name_with_type }}
                                    </p>  
                                </div>
                                @if ($address->is_default == 0)
                                    <form action="{{ route('client.profile.set-address', $address) }}" method="POST">
                                        @csrf
                                        <button
                                            class="ml-auto rounded border border-gray-300 px-3 py-1 text-xs text-gray-700 hover:border-[#D30A0A] hover:text-[#D30A0A]"
                                            type="submit">
                                            Thiết lập mặc định
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <div class="flex flex-col items-center justify-center gap-4 text-right md:flex-row">
                                <a class="button-light" href="{{ route('client.profile.edit-location', $address) }}">Sửa</a>
                                @if ($address->is_default == 0)
                                    <a class="link-md" data-modal-target="delete-modal-{{ $address->id }}"
                                        data-modal-toggle="delete-modal-{{ $address->id }}"
                                        href="#">@svg('tabler-trash', 'icon-md')</a>
                                @endif
                            </div>
                        </div>
                        {{-- start modal --}}
                        <div class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
                            id="delete-modal-{{ $address->id }}" tabindex="-1">
                            <div class="relative max-h-full w-full max-w-md p-4">
                                <div class="relative rounded-lg bg-white shadow">
                                    <button
                                        class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
                                        data-modal-hide="delete-modal-{{ $address->id }}" type="button">
                                        @svg('tabler-x', 'w-4 h-4')
                                    </button>
                                    <div class="p-4 text-center md:p-5">
                                        <div class="flex justify-center">
                                            @svg('tabler-map-2', 'w-12 h-12 text-red-600 text-center mb-2')
                                        </div>
                                        <h3 class="my-10 font-normal">Bạn có muốn xóa địa chỉ này không?</h3>
                                        <div class="flex justify-center gap-4">
                                            <form class="w-full"
                                                action="{{ route('client.profile.delete-location', $address) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="button-red w-full" type="submit">
                                                    Xóa
                                                </button>
                                            </form>

                                            <button class="button-dark w-full"
                                                data-modal-hide="delete-modal-{{ $address->id }}" type="button">Không,
                                                trở lại</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="p-1">
                    {{ $addresses->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
