@extends('layouts.client')

@section('title', 'Điểm hội viên')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="lg:flex">

            @include('clients.profile.sidebar')

            <div class="card p-4 md:p-8 w-full min-h-screen">
                <h3 class="font-semibold uppercase mb-8">điểm hội viên</h3>

                {{-- Điểm hội viên --}}
                <div class="flex flex-col md:flex-row items-center gap-8 mb-8">
                    <img src="{{ asset('storage/uploads/ranks/gold.svg') }}" alt="" class="img-md">
                    <div class="w-full">
                        <div class="flex items-center justify-between mb-1">
                            <p class="uppercase font-semibold text-yellow-300">vàng</p>
                            <p class="text-sm font-medium">3850 Điểm</p>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 45%"></div>
                        </div>
                        <p class="text-sm">Tích thêm 534 điểm nữa để nâng cấp lên thành viên Kim cương</p>
                    </div>
                </div>

                {{-- faq --}}
                <div>
                    <p class="title">Các câu hỏi hường gặp (FAQ)</p>

                    <div class="card p-4">
                        @for ($i = 1; $i < 5; $i++)
                            <div class="border-b border-gray-300 mb-4">
                                <button onclick="toggleAccordion({{ $i }})"
                                    class="w-full flex justify-between items-center py-4">
                                    <span class="font-medium">{{ $i }}. Điểm hội viên là gì</span>
                                    <span id="icon-1" class="transition">
                                        @svg('tabler-plus', 'icon-sm')
                                    </span>
                                </button>
                                <div id="content-{{ $i }}" class="max-h-0 overflow-hidden transition">
                                    <div class="pb-4 text-sm">
                                        Điểm hội viên là abc xyz
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Diem hoi vien script --}}
    <script>
        function toggleAccordion(index) {
            const content = document.getElementById(`content-${index}`);
            const icon = document.getElementById(`icon-${index}`);

            const minusSVG = `@svg('tabler-minus', 'icon-sm')`;

            const plusSVG = `@svg('tabler-plus', 'icon-sm')`;

            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                content.style.maxHeight = '0';
                icon.innerHTML = plusSVG;
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.innerHTML = minusSVG;
            }
        }
    </script>
@endsection
