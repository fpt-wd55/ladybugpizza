@php
    $categories = \App\Models\Category::all();
@endphp

<div class="flex flex-wrap items-center gap-4 mb-4 md:mb-8">
    @foreach ($categories as $category)
        {{ $category->name }}
    @endforeach
</div>
