@extends('layouts.client')

@section('title', 'Điểm hội viên')

@section('content')
    <div class="min-h-screen p-4 transition md:mx-24 md:p-8 lg:mx-32">
        <div class="lg:flex">
            @include('clients.profile.sidebar')

            <div>
                <div class="card mb-8 w-full p-4 md:p-8">
                    <div class="flex items-start justify-between">
                        <h3 class="mb-8 font-semibold uppercase">Điểm hội viên</h3>
                        <a class="button-red" href="{{ route('client.profile.membership-history') }}">
                            @svg('tabler-history', 'icon-md md:me-2')
                            <span class="hidden md:inline-flex">Lịch sử sử dụng điểm</span>
                        </a>
                    </div>
                    {{-- Điểm hội viên --}}
                    <div class="mb-8 flex flex-col items-center gap-8 md:flex-row">
                        <img alt="" class="img-md" loading="lazy" src="{{ asset($img) }}">
                        <div class="w-full">
                            <div class="mb-1 flex items-center justify-between">
                                <p class="font-semibold uppercase text-yellow-300">{{ $rank }}</p>
                                <p class="text-sm font-medium">{{ $points }} Điểm</p>
                            </div>
                            <div class="mb-2 h-2 w-full rounded-full bg-gray-200">
                                <div class="h-2 rounded-full bg-red-500" style="width: {{ $progress ?? '0' }}%;"></div>
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
                            <div class="mb-4 border-b border-gray-300">
                                <button class="flex w-full items-center justify-between py-4" onclick="toggleAccordion({{ $index }})">
                                    <span class="text-left text-sm font-normal">{{ $index + 1 }}.
                                        {{ $faq['question'] }}</span>
                                    <span class="transition" id="icon-1">
                                        @svg('tabler-plus', 'icon-sm')
                                    </span>
                                </button>
                                <div class="max-h-0 overflow-hidden transition" id="content-{{ $index }}">
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
