<head>
    <div class="h-auto mx-[16px] mx-8 lg:mx-20">
        <nav class="flex justify-between items-center p-4 ">
            <span class="lg:hidden" data-dropdown-toggle="dropdown">
                @svg('tabler-menu-2')
            </span>
            <span class="md:flex md:items-center">
                <img class="w-20 h-20" src="{{ asset('storage/uploads/logos/logo-fill.png') }}" alt="">
            </span>
            <div>
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100  dark:bg-gray-700 ">
                    <div class="flex justify-center pt-5 mx-4">
                        <form class="flex items-center">
                            <input type="text" placeholder="Tìm kiếm..."
                                class="border border-gray-300 rounded p-2 w-96" />
                            <button type="submit" class=" mx-3 bg-[#D30A0A] text-white rounded p-2 ">
                                @svg('tabler-search')
                            </button>
                        </form>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 font-bold" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">TRANG
                                CHỦ</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">THỰC
                                ĐƠN</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">VỀ
                                CHÚNG TÔI</a>
                        </li>
    
                    </ul>
                </div>
            </div>
          
           


            <ul class=" hidden lg:flex lg:items-center mx-auto open-sans ">
                <li class="mx-10 font-bold">
                    <a href="#">TRANG CHỦ</a>
                </li>
                <li class="mx-10 font-bold "><a href="#">THỰC ĐƠN</a></li>
                <li class="mx-10 font-bold "><a href="#">VỀ CHÚNG TÔI</a></li>
            </ul>


            <div class="flex items-center">

                <span class="hidden md:inline-block md:mx-3">@svg('tabler-search')</span>
                <span class="lg:hidden text-red-500">@svg('tabler-heart-filled')</span>
                <span class="mx-3"> @svg('tabler-shopping-bag')</span>

                <span class="mx-2"><img data-dropdown-toggle="dropdownAvatarName" class=" w-5 h-5 rounded-full"
                        src="{{ asset('storage/uploads/products/pizza/pizza_margherita.jpeg') }}" alt=""></span>
                {{-- <span class="lg:hidden">@svg('tabler-logout')</span> --}}
                {{-- <button type="button" class="hidden md:inline-block focus:outline-none text-white bg-[#FF0000]  font-medium rounded-lg text-sm px-6 py-2 me-2 mb-2 ">Đăng Nhập</button> --}}
            </div>

            <!-- Dropdown menu -->
            <div id="dropdownAvatarName"
                class="  z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow  dark:bg-gray-700 dark:divide-gray-600">

                <div class=" px-4 py-3 text-sm text-gray-900 dark:text-white">
                    <div class="font-medium ">Đỗ Hồng Quân</div>
                    <div class="truncate">quandohong28@gmail.com</div>
                </div>
                <div class="py-2">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Hồ
                        sơ</a>
                </div>
                <div class="py-2">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Địa
                        chỉ</a>
                </div>
                <div class="py-2">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Cài
                        đặt thông báo</a>
                </div>
                <div class="py-2">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Tích
                        điểm</a>
                </div>
                <div class="py-2">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Mã
                        giảm giá</a>
                </div>
                <div class="py-2">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Đăng
                        suất</a>
                </div>
            </div>

        </nav>
    </div>

</head>
