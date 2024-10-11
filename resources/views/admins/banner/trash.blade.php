@extends('layouts.admin')
@section('title', 'Banner | Thùng rác')
@section('content')
    {{ Breadcrumbs::render('admin.trash.listBanner') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="flex flex-col md:flex-row items-center justify-end space-y-3 md:space-y-0 md:space-x-4 px-4 mb-2">
            <div
                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">

                <div class="flex items-center space-x-3 w-full md:w-auto">

                    <a href="{{ route('admin.banners.index') }}">
                        <button type="button" class="rounded-lg button-blue">Trở Lại</button>
                    </a>

                </div>
            </div>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-3">
            @forelse ($deleteBanner as $item)
                {{-- star item --}}

                <div class="shadow border-gray-700 bg-slate-500 h-auto card">
                    <div class="h-44 overflow-hidden">
                        <img loading="lazy" src="{{ asset('storage/uploads/banners/' . $item->image) }}"
                            class="w-full h-full object-cover hover:scale-125 transition rounded-t-lg" alt="">
                    </div>
                    <div class="flex justify-around">
                        <div class="flex items-center mt-2 text-lg font-medium text-gray-900">
                            <div class="inline-block indicator {{ $item->status == 1 ? 'bg-green-700' : 'bg-red-700' }}">
                            </div>
                            {{ $item->status == 1 ? 'Hoạt động' : 'Khóa' }}
                        </div>
                    </div>
                    <div class="text-center p-2 mb-1 min-h-24">
                        <span
                            class="text-sm text-gray-500 hover:underline hover:text-[#D30A0A] hover:scale-105 hover:bg-gray-100 transition">{{ $item->url }}
                        </span>
                    </div>
                    <div class="flex mb-5 justify-around">
                        <a href="#" data-modal-target="restore-modal-{{ $item->id }}"
                            data-modal-toggle="restore-modal-{{ $item->id }}"
                            class="cursor-pointer block  text-sm  text-gray-500 hover:text-green-500 " title="Restore">
                            <button class="w-36 md:w-32 lg:w-36 button-green">

                                Khôi phục <span>@svg('tabler-restore', 'w-7 h-7 pl-1')</span>
                            </button>
                        </a>


                        <a href="#" data-modal-target="delete-modal-{{ $item->id }}"
                            data-modal-toggle="delete-modal-{{ $item->id }}"
                            class="cursor-pointer block px-1 text-sm  text-gray-500 hover:text-red-500 " title="Delete">
                            <button class="w-32 md:w-24 lg:w-32 button-red">

                                Xóa @svg('tabler-trash-x-filled', 'w-7 h-7 pl-1')
                            </button>

                        </a>
                    </div>
                </div>
                {{-- start modal restore --}}
                <div id="restore-modal-{{ $item->id }}" tabindex="-1"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow">
                            <button type="button"
                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="restore-modal-{{ $item->id }}">
                                @svg('tabler-x', 'w-4 h-4')
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <div class="flex justify-center">
                                    @svg('tabler-arrow-back-up-double', 'w-12 h-12 text-green-600 text-center mb-2 ')
                                </div>
                                <h3 class="mb-5 font-normal">Bạn có muốn khôi phục Banner này không?</h3>
                                <div class=" flex justify-center ">

                                    <form action="{{ route('admin.trash.bannerRestore', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Có
                                        </button>
                                    </form>

                                    <button data-modal-hide="restore-modal-{{ $item->id }}" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-0">Không,
                                        trở lại</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end modal restore --}}
                {{-- start modal delete --}}
                <div id="delete-modal-{{ $item->id }}" tabindex="-1"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow">
                            <button type="button"
                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="delete-modal-{{ $item->id }}">
                                @svg('tabler-x', 'w-4 h-4')
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <div class="flex justify-center">
                                    @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                                </div>
                                <h3 class="mb-5 font-normal">Bạn có muốn xóa vĩnh viễn Banner này không?</h3>
                                <div class=" flex justify-center">

                                    <form action="{{ route('admin.trash.bannerDelete', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-0 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Xóa
                                        </button>
                                    </form>
                                    <button data-modal-hide="delete-modal-{{ $item->id }}" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-0">Không,
                                        trở lại</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end modal delete --}}
                {{-- end item --}}
            @empty
                <div class="col-span-2 flex flex-col  items-center justify-center  p-6 rounded-lg bg-white w-full h-96">
                    @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                    <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                </div>
            @endforelse
        </div>
        <div class="p-4">
            {{ $deleteBanner->links() }}
        </div>
    </div>
@endsection
