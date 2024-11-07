@extends('layouts.admin')
@section('title', 'Banner | Thùng rác')
@section('content')
    {{ Breadcrumbs::render('admin.trash.listBanner') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h2 class="font-medium text-gray-700 text-base">
                    Thùng rác
                </h2>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <a href="{{ route('admin.banners.index') }}">
                    <button type="button" class="rounded-lg button-blue">Trở Lại</button>
                </a>
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            @forelse ($deleteBanner as $item)
                {{-- star item --}}
                <div class="card h-auto border-gray-700 bg-slate-500 shadow relative">
                    <div class="h-52 overflow-hidden rounded-t">
                        <a class="overflow-hidden" data-fslightbox="gallery" href="{{ asset('storage/uploads/banners/' . $item->image) }}">
                            <img class="h-full w-full object-cover transition hover:scale-105" loading="lazy" src="{{ asset('storage/uploads/banners/' . $item->image) }}">
                        </a>
                    </div>
                    <div class="flex items-start justify-between p-4">
                        <div class="flex justify-around">
                            <div class="">
                                <div class="mb-2 flex items-center text-gray-900">
                                    <div class="indicator {{ $item->status == 1 ? 'bg-green-700' : 'bg-red-700' }} inline-block">
                                    </div>
                                    <span>{{ $item->status == 1 ? 'Hoạt động' : 'Khóa' }}</span>
                                </div>
                                <div class="text-center">
                                    <a class="text-sm text-gray-500 transition hover:scale-105 hover:bg-gray-100 hover:text-[#D30A0A] hover:underline" href="{{ $item->url }}" href="" target="blank">{{ $item->url }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex absolute bottom-0 right-0 p-4">
                            <a href="#" data-modal-target="restore-modal-{{ $item->id }}"
                                data-modal-toggle="restore-modal-{{ $item->id }}"
                                class="cursor-pointer block px-1 text-sm  text-gray-500 hover:text-green-500 "
                                title="Restore">
                                @svg('tabler-restore', 'w-7 h-7')
                            </a>


                            <a href="#" data-modal-target="delete-modal-{{ $item->id }}"
                                data-modal-toggle="delete-modal-{{ $item->id }}"
                                class="cursor-pointer block  text-sm  text-gray-500 hover:text-red-500 "
                                title="Delete">
                                @svg('tabler-trash-x-filled', 'w-7 h-7 ')
                            </a>
                        </div>
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
                <div class="col-span-2 md:col-span-3 flex flex-col  items-center justify-center  p-6 rounded-lg bg-white w-full h-96">
                    @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                    <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                </div>
            @endforelse
        </div>
        <div class="p-4">
            {{ $deleteBanner->onEachSide(1)->links() }}
        </div>
    </div>
@endsection
