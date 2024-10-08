@extends('layouts.client')

@section('title', 'Điểm hội viên')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="lg:flex">
            @include('clients.profile.sidebar')

            <div>
                <div class="card p-4 md:p-8 w-full mb-8">
                    <h3 class="font-semibold uppercase mb-8">Điểm hội viên</h3>
                    {{-- Điểm hội viên --}}
                    <div class="flex flex-col md:flex-row items-center gap-8 mb-8">
                        <img src="{{ asset($img) }}" alt="" class="img-md">
                        <div class="w-full">
                            <div class="flex items-center justify-between mb-1">
                                <p class="uppercase font-semibold text-yellow-300">{{ $rank }}</p>
                                <p class="text-sm font-medium">{{ $points }} Điểm</p>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width:{{ $progress }}%"></div>
                            </div>
                            <p class="text-sm">Tích thêm {{ $nextPoints }} điểm nữa để nâng cấp lên thành viên
                                {{ $nextRank }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- faq --}}
                <div>
                    <div class="card p-4 md:p-8">
                        <p class="title">Các câu hỏi hường gặp (FAQ)</p>
                        @foreach ($faqs as $index => $faq)
                            <div class="border-b border-gray-300 mb-4">
                                <button onclick="toggleAccordion({{ $index }})"
                                    class="w-full flex justify-between items-center py-4">
                                    <span class="font-normal text-sm text-left">{{ $index + 1 }}. {{ $faq['question'] }}</span>
                                    <span id="icon-1" class="transition">
                                        @svg('tabler-plus', 'icon-sm')
                                    </span>
                                </button>
                                <div id="content-{{ $index }}" class="max-h-0 overflow-hidden transition">
                                    <div class="pb-4 text-sm">
                                        {{ $faq['answer'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
