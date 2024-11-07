@php
    $categories = \App\Models\Category::all();
@endphp

<footer class="mb-16 border-t p-4 md:px-8 md:py-4 lg:mb-0 lg:px-24">

    <div class="grid grid-cols-1 items-start gap-8 py-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="flex flex-col items-start justify-center">
            <img alt="logo" class="mb-4 w-16 object-cover" loading="lazy"
                src="{{ asset('storage/uploads/logo/logo.svg') }}">
            <p class="text-lg font-semibold">Ladybug Pizza</p>
        </div>
        <div>
            <ul class="space-y-4">
                <li><a class="text-sm font-medium uppercase transition hover:text-red-500"
                        href="{{ route('client.product.menu') }}">THỰC ĐƠN</a></li>
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($categories as $category)
                        <li><a class="text-sm transition hover:text-red-500"
                                href="{{ route('client.product.menu') . '#' . $category->slug }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </div>
            </ul>
        </div>
        <div>
            <ul class="space-y-4">
                <li><a class="text-sm transition hover:text-red-500" href="{{ route('client.contact') }}">Liên hệ</a>
                </li>
                @foreach ($pages as $page)
                    <li>
                        <a class="text-sm transition hover:text-red-500" href="{{ route('client.dynamic-page', $page->slug) }}">{{ $page->title }}</a>
                        </li>
                @endforeach
            </ul>
        </div>
    </div>
    <hr>
    <div class="flex items-center justify-between pt-4">
        <p class="text-center text-sm">© 2021 Ladybug Pizza. All rights reserved.</p>
        <div class="flex items-center gap-4">
            <a class="transition hover:text-red-500" href="#" target="_blank">@svg('tabler-brand-facebook', 'icon-md')</a>
            <a class="transition hover:text-red-500" href="#" target="_blank">@svg('tabler-brand-instagram', 'icon-md')</a>
            <a class="transition hover:text-red-500" href="#" target="_blank">@svg('tabler-brand-twitter', 'icon-md')</a>
        </div>
    </div>
</footer>
