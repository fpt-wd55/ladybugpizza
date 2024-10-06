@unless ($breadcrumbs->isEmpty())
    <nav class="mb-4 flex pe-4 pt-2" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="inline-flex items-center">
                        <a href="{{ $breadcrumb->url }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <li>
                        <div class="flex items-center">
                            <p class="text-sm font-medium text-gray-700 hover:text-primary-600">
                                {{ $breadcrumb->title }}
                            </p>
                        </div>
                    </li>
                @endif
                @unless ($loop->last)
                    @svg('tabler-chevron-right', 'h-4 w-4 text-gray-400 me-2')
                @endif
                @endforeach
            </ol>
        </nav>
    @endunless
