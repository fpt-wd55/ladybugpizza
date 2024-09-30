<footer class="border-t p-4 md:px-8 lg:px-24 md:py-4">
    
    <div class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 items-center">
        <div class="flex flex-col items-center justify-center md:items-start">
            <img class="w-20 " src="{{ asset('storage/uploads/logos/logo-fill.png') }}" alt="logo">
            <p class="uppercase font-semibold mb-4 text-sm">Kết nối với chúng tôi</p>
            <div class="flex items-center gap-4">
                <a href="#" target="_blank" class="hover:text-red-500 transition">@svg('tabler-brand-facebook')</a>
                <a href="#" target="_blank" class="hover:text-red-500 transition">@svg('tabler-brand-instagram')</a>
                <a href="#" target="_blank" class="hover:text-red-500 transition">@svg('tabler-brand-twitter')</a>
            </div>
        </div>
        <div>
            <ul class="space-y-4">
                <li><a href="{{ route('client.home') }}"
                        class="uppercase hover:text-red-500 transition text-sm font-semibold">trang chủ</a></li>
                <li><a href="{{ route('client.product.menu') }}"
                        class="uppercase hover:text-red-500 transition text-sm font-semibold">thực đơn</a></li>
                <li><a href="{{ route('client.about-us') }}"
                        class="uppercase hover:text-red-500 transition text-sm font-semibold">về chúng tôi</a></li>
            </ul>
        </div>
        <div>
            <ul class="space-y-4">
                <li><a href="#" class="uppercase hover:text-red-500 transition text-sm font-semibold">liên hệ</a>
                </li>
                <li><a href="{{ route('client.manual') }}"
                        class="uppercase hover:text-red-500 transition text-sm font-semibold">hướng dẫn mua hàng</a>
                </li>
                <li><a href="{{ route('client.policies') }}"
                        class="uppercase hover:text-red-500 transition text-sm font-semibold">chính sách và điều
                        khoản</a></li>
            </ul>
        </div>
    </div>
</footer>
