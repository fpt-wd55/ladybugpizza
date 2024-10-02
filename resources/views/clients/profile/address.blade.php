@extends('layouts.client')

@section('title', 'Địa chỉ')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="lg:flex">

            @include('clients.profile.sidebar')

            <div class="card p-4 md:p-8 w-full min-h-screen">
                <div class="flex items-start justify-between mb-8">
                    <h3 class="font-semibold uppercase ">địa chỉ</h3>
                    <button class="button-red" data-modal-target="addAddressModal" data-modal-toggle="addAddressModal">
                        @svg('tabler-plus', 'icon-md, me-2')
                        Thêm địa chỉ
                    </button>

                    {{-- add address modal --}}
                    <div id="addAddressModal" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full max-w-2xl h-auto">
                            <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Thêm địa chỉ mới
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="addAddressModal">
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
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Địa chỉ
                                                chi tiết</label>
                                            <textarea type="text" name="name" id="name" value="" class="text-area" placeholder=""></textarea>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <button type="submit" class="button-red">
                                            Thêm mới
                                        </button>
                                        <button type="button" class="button-dark">
                                            Huỷ
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    @for ($i = 0; $i < 3; $i++)
                        <div class="card p-4 mb-4 flex justify-between">
                            <div>
                                <div class="flex items-center gap-4 mb-2">
                                    <p class="font-medium">Nhà riêng</p>
                                    @if ($i == 0)
                                        <span class="badge-red">Mặc định</span>
                                    @endif
                                </div>
                                <div class="text-sm">
                                    <p>Đỗ Hồng Quân</p>
                                    <p>0362303364</p>
                                    <p class="line-clamp-2">Số 7, Ngõ 126/14 Mễ Trì Hạ Phường Mễ Trì, Quận Nam Từ Liêm, Hà
                                        Nội
                                    </p>
                                </div>
                            </div>
                            <div class="text-right flex flex-col md:flex-row gap-4 items-center justify-center">
                                <a href="#" class="link-md" data-modal-target="editAddressModal-{{ $i }}"
                                    data-modal-toggle="editAddressModal-{{ $i }}">Sửa</a>
                                <a href="#" class="link-md" data-modal-target="deleteAddressModal-{{ $i }}"
                                    data-modal-toggle="deleteAddressModal-{{ $i }}">@svg('tabler-trash', 'icon-md')</a>

                            </div>
                        </div>

                        {{-- adit adress Modal --}}
                        <div id="editAddressModal-{{ $i }}" tabindex="-1" aria-hidden="true"
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
                                            <button type="submit" class="button-red">
                                                Thêm mới
                                            </button>
                                            <button type="button" class="button-dark">
                                                Huỷ
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- delete confirm Modal --}}
                        <div id="deleteAddressModal-{{ $i }}" tabindex="-1" aria-hidden="true"
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
                                        <button type="submit" class="button-red">
                                            Xóa
                                        </button>
                                        <button type="button" class="button-dark">
                                            Huỷ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
