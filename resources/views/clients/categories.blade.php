@php
    $categories = \App\Models\Category::all();
@endphp

<div class="flex flex-wrap items-center justify-between gap-4 mb-4 md:mb-8">
    @foreach ($categories as $category)
        <a href="{{ route('client.product.menu', ['category' => $category->slug]) }}"
            class="flex flex-col items-center justify-center">
            <img src="{{ asset('storage/uploads/categories/' . $category->image) }}"
                class="w-12 h-12 object-cover hover:transform hover:scale-110 transition-transform" alt="">
            <p class="font-normal text-sm">{{ $category->name }}</p>
        </a>
    @endforeach
</div>
