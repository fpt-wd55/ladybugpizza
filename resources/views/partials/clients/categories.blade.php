@php
    $categories = App\Models\Category::where('status', 1)
        ->where('id', '!=', 7)
        ->whereHas('products', function ($query) {
            $query->where('status', 1); // Assuming you have a status field in products
        })
        ->get();
@endphp

<div class="grid grid-cols-3 gap-4 md:gap-8 mb-4 md:mb-8 py-8">
    @foreach ($categories as $category)
        @if ($category->id == 7)
            @continue
        @endif
        <a href="{{ route('client.product.menu') . '#' . $category->slug }}"
            class="flex flex-col items-center justify-center">
            <img src="{{ asset('storage/uploads/categories/' . $category->image) }}"
                class="w-20 h-20 rounded-md md:w-24 md:h-24 object-cover hover:transform hover:scale-110 transition-transform mb-2"
                alt="">
            <p class="font-normal md:text-sm text-xs">{{ $category->name }}</p>
        </a>
    @endforeach
</div>
