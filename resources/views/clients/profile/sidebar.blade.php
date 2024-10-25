<ul class="flex-column space-y space-y-4 text-sm lg:me-4 mb-4 lg:mb-0 text-gray-700">
    <li>
        <a href="{{ route('client.profile.index') }}" class="inline-flex items-center gap-2 px-4 py-3 font-normal {{ request()->is('profile') ? 'text-white bg-red-700' : 'bg-gray-100 hover:bg-gray-200' }} rounded-lg w-full lg:w-48">
            @svg('tabler-user', 'icon-md')
            Tài khoản
        </a>
    </li>
    <li>
        <a href="{{ route('client.profile.address') }}" class="inline-flex items-center gap-2 px-4 py-3 font-normal rounded-lg {{ request()->is('profile/address') ? 'text-white bg-red-700' : 'bg-gray-100 hover:bg-gray-200' }} w-full lg:w-48">
            @svg('tabler-location', 'icon-md')
            Địa chỉ
        </a>
    </li>
    <li>
        <a href="{{ route('client.profile.settings') }}" class="inline-flex items-center gap-2 px-4 py-3 font-normal rounded-lg {{ request()->is('profile/settings') ? 'text-white bg-red-700' : 'bg-gray-100 hover:bg-gray-200' }} w-full lg:w-48">
            @svg('tabler-settings', 'icon-md')
            Cài đặt
        </a>
    </li>
    <li>
        <a href="{{ route('client.profile.membership') }}" class="inline-flex items-center gap-2 px-4 py-3 font-normal rounded-lg {{ request()->is('profile/membership') ? 'text-white bg-red-700' : 'bg-gray-100 hover:bg-gray-200' }} w-full lg:w-48">
            @svg('tabler-coin', 'icon-md')
            Điểm hội viên
        </a>
    </li>
    <li>
        <a href="{{ route('client.profile.promotion') }}" class="inline-flex items-center gap-2 px-4 py-3 font-normal rounded-lg {{ request()->is('profile/promotion') ? 'text-white bg-red-700' : 'bg-gray-100 hover:bg-gray-200' }} w-full lg:w-48">
            @svg('tabler-tag', 'icon-md')
            Mã giảm giá
        </a>
    </li>
</ul>