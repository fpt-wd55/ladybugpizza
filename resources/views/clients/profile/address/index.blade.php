@extends('layouts.client')

@section('title', 'Địa chỉ')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="lg:flex">

            @include('clients.profile.sidebar')

            <div class="card p-4 md:p-8 w-full flex flex-col min-h-screen">
                <div class="flex items-start justify-between mb-8">
                    <h3 class="font-semibold uppercase ">địa chỉ</h3>
                    <a class="button-red" href="{{ route('client.profile.add-location') }}">
                        @svg('tabler-plus', 'icon-md me-2')
                        Thêm địa chỉ
                    </a>
                </div>

                <div class="flex-grow">
                    @foreach ($addresses as $address)
                        <div class="card p-4 mb-4 flex justify-between">
                            <div>
                                <div class="flex items-center gap-4 mb-2">
                                    <p class="font-medium">{{ $address->title }}</p>
                                    @if ($address->is_default == 1)
                                        <span class="badge-red">Mặc định</span>
                                    @endif
                                </div>
                                <div class="text-sm mb-2">
                                    <div class="flex items-center mb-1">
                                        <p class="uppercase">{{ $address->user->fullname }}</p>
                                        <span class="mx-2 h-5 border-l border-gray-300"></span>
                                        <p class="text-gray-600 text-base">(+84) {{ $address->phone }}</p>
                                    </div>
                                    <p class="line-clamp-2 text-gray-600 text-base">{{ $address->detail_address }}, {{ $address->ward }},
                                        {{ $address->district }}, {{ $address->province }}
                                    </p>
                                </div>
                                @if ($address->is_default == 0)
                                <button class="ml-auto border border-gray-300 text-gray-700 px-3 py-1 rounded text-sm hover:text-red-500  hover:border-red-500">Thiết lập mặc định</button>
                                @endif
                               
                            </div>
                            <div class="text-right flex flex-col md:flex-row gap-4 items-center justify-center">
                                <a href="{{ route('client.profile.edit-location', $address) }}" class="link-md">Sửa</a>
                                <a href="#" class="link-md">@svg('tabler-trash', 'icon-md')</a>
                            </div>
                        </div>

                        {{-- edit adress Modal --}}
                        {{-- <div id="editAddressModal-{{ $i }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-2xl h-auto">
                                <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Sửa địa chỉ
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="editAddressModal-{{ $i }}">
                                            @svg('tabler-x', 'icon-sm')
                                        </button>
                                    </div>
                                    <form action="#">
                                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                            <div class="col-span-2">
                                                <label for="name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại
                                                    địa chỉ</label>
                                                <input type="text" name="name" id="name" value=""
                                                    class="input" placeholder="">
                                            </div>
                                            <div>
                                                <label for="name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tỉnh/Thành
                                                    phố</label>
                                                <input type="text" name="name" id="name" value=""
                                                    class="input" placeholder="">
                                            </div>
                                            <div>
                                                <label for="name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quận/Huyện</label>
                                                <input type="text" name="name" id="name" value=""
                                                    class="input" placeholder="">
                                            </div>
                                            <div>
                                                <label for="name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Xã/Phường</label>
                                                <input type="text" name="name" id="name" value=""
                                                    class="input" placeholder="">
                                            </div>
                                            <div class="col-span-2">
                                                <label for="name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Địa
                                                    chỉ
                                                    chi tiết</label>
                                                <textarea type="text" name="name" id="name" value="" class="text-area" placeholder=""></textarea>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <button data-modal-hide="editAddressModal" type="submit" class="button-red">
                                                Thêm mới
                                            </button>
                                            <button data-modal-hide="editAddressModal" type="button" class="button-gray">
                                                Huỷ
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> --}}

                        {{-- delete confirm Modal --}}
                        {{-- <div id="deleteAddressModal-{{ $i }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-2xl h-auto">
                                <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Xác nhận xóa
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="deleteAddressModal-{{ $i }}">
                                            @svg('tabler-x', 'icon-sm')
                                        </button>
                                    </div>
                                    <div class="flex flex-col items-center justify-center gap-4 mb-8">
                                        <div>@svg('tabler-alert-triangle', 'icon-2xl text-red-500')</div>
                                        <p>Bạn có chắc chắn muốn xóa địa chỉ này không?</p>
                                    </div>
                                    <div class="flex items-center gap-4 justify-center">
                                        <button data-modal-hide="deleteAddressModal" type="submit" class="button-red">
                                            Xóa
                                        </button>
                                        <button data-modal-hide="deleteAddressModal" type="button" class="button-gray">
                                            Huỷ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    @endforeach
                    
                </div>
                <div class="p-1">
                    {{ $addresses->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
