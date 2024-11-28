@extends('layouts.admin')
@section('title', 'Combo | Đánh giá')
@section('content')
    {{ Breadcrumbs::render('admin.combos.evaluation', $combo) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <div>
                <div class="lg:flex">
                    <div class=" p-2 md:p-8 w-full min-h-screen">
                        <h3 class="font-semibold text-lg uppercase mb-8">Lịch Sử Đánh Giá</h3>
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                            @forelse ($evaluations as $item)
                                <div class="card p-2 mb-4">
                                    <div class="mb-2 flex justify-center md:gap-1 lg:gap-4">
                                        <div class="flex items-center p-2 text-gray-900 whitespace-nowrap">
                                            <img loading="lazy"
                                                src="{{ filter_var($item->user->avatar, FILTER_VALIDATE_URL) ? $item->user->avatar : ($item->user->avatar ? asset('storage/uploads/avatars/' . $item->user->avatar) : asset('storage/uploads/avatars/user-default.png')) }}"
                                                alt="Avatar" class="w-8 h-8 mr-3 img-circle object-cover">
                                            <div class="grid grid-flow-row">
                                                <span class="text-sm">{{ $item->user->fullname }} |
                                                    {{ $item->created_at->format('d-m-Y H:i') }}</span>
                                                <span class="text-sm text-gray-500 flex">
                                                    <div class="flex items-center gap-0.5">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            @if ($i < $item->rating)
                                                                @svg('tabler-star-filled', 'icon-sm text-red-500')
                                                            @else
                                                                @svg('tabler-star', 'icon-sm text-red-500')
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-auto self-start">
                                            <div class="flex items-center justify-center">
                                                <div
                                                    class="inline-block indicator rounded-full {{ $item->status == 1 ? 'bg-green-700' : 'bg-red-700' }} ">
                                                </div>
                                                {{ $item->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                                                <div class="px-1 py-3 flex items-center float-right">
                                                    <button id="{{ $item->id }}-dropdown-button"
                                                        data-dropdown-toggle="{{ $item->id }}-dropdown"
                                                        class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none pt-1"
                                                        type="button">
                                                        @svg('tabler-dots-vertical', 'w-5 h-5')
                                                    </button>
                                                    <div id="{{ $item->id }}-dropdown"
                                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                                        <ul class="py-1 text-sm text-gray-700"
                                                            aria-labelledby="{{ $item->id }}-dropdown-button">
                                                            <li class="block py-2 px-4 hover:bg-gray-100">
                                                                <div class="flex gap-x-2 items-center">
                                                                    <p class="">Trạng Thái</p>
                                                                    <form
                                                                        action="{{ route('admin.combos.evaluation.update', $item) }}"
                                                                        method="POST" class="mt-1">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <label for="status-toggle-{{ $item->id }}"
                                                                            class="inline-flex relative items-center cursor-pointer">
                                                                            <input type="checkbox"
                                                                                id="status-toggle-{{ $item->id }}"
                                                                                name="status" class="sr-only peer"
                                                                                value="1"
                                                                                {{ $item->status == 1 ? 'checked' : '' }}
                                                                                onchange="this.form.submit()">
                                                                            <div
                                                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none  rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                                            </div>
                                                                        </label>
                                                                    </form>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4 px-9 md:px-12 lg:px-14">
                                        <p class="mb-3 text-sm">{{ $item->comment }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
                                    @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                    <p class="mt-4 text-gray-500 text-sm">Combo này chưa có đánh giá nào.</p>
                                </div>
                            @endforelse
                            <div class="p-4">
                                {{ $evaluations->onEachSide(1)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
