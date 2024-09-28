@extends('layouts.client')

@section('title','Trang chủ')
  

@section('content')

<div class="mx-auto px-0  ">
    <div id="default-carousel" class="relative w-full mb-[44px] md:mb-[76px] lg:mb-[64px]" data-carousel="slide">
      <!-- Carousel wrapper -->
      <div class="relative h-[230px] overflow-hidden  md:h-[400px] lg:h-[650px]">
        <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="{{ asset('storage/uploads/banners/banner.jpg') }}" class="object-cover absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Test image">
        </div>
        <!-- Item 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="{{ asset('storage/uploads/banners/banner.jpg') }}" class=" object-cover absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Test image">
        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="{{ asset('storage/uploads/banners/banner.jpg') }}" class="object-cover absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Test image">
        </div>
        <!-- Item 4 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="{{ asset('storage/uploads/banners/banner.jpg') }}" class="object-cover absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Test image">
        </div>
      </div>
      <!-- Slider indicators -->
      <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="3"></button>
      </div>
      <!-- Slider controls -->
      <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
          <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
          </svg>
          <span class="sr-only">Previous</span>
        </span>
      </button>
      <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
          <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
          <span class="sr-only">Next</span>
        </span>
      </button>
    </div>
    <!-- end slide show -->
    
    <div class="h-auto mx-[16px] md:mx-8 lg:mx-20">
      <div class="flex justify-between " >
        <p class="pl-2 pt-[9px] label-sm  md:text-base  lg:text-xl">Sản Phẩm Nổi Bật</p>
        <a href="" class="pr-2 pt-[9px]   label-sm md:text-base lg:text-xl">Xem thêm</a>
      </div>
      <div class="grid grid-cols-2 grid-rows-3 gap-5 mx-auto md:grid-cols-3 md:grid-rows-2 md:gap-5">
        <!-- item -->
        @foreach ($listProHome as $listPro)
            
        <a href="#">

          <div class=" h-[280px] md:flex md:h-[140px]">
             <div class="mb-1 h-40 md:h-32 md:mb-0">
              <img src="{{ asset('storage/uploads/products/pizza/pizza_4_ormaggi.webp') }}" class="h-full w-full rounded-tl-sm  rounded-tr-sm object-cover" alt="">
             </div>
              <div class="">
               <div class=""><p class="pl-2 label-sm md:text-sm lg:text-base">{{$listPro->name}}</p></div>
               <div class="flex pl-2">
                 <p class=" underline pr-1 label-sm md:text-sm lg:text-base">{{$listPro->avg_rating}}</p>
               
                 
                 @for($i = 1; $i <= 5; $i++)
                  @if($i <= $listPro->avg_rating)
                      @svg('tabler-star-filled', 'icon-sm md:w-5 md:h-5 lg:w-6 lg:h-6 text-[#D30A0A]')
                  @else
                      @svg('tabler-star', 'icon-sm md:w-5 md:h-5 lg:w-6 lg:h-6 text-[#D30A0A]')
                  @endif
              @endfor
                 <p class=" pl-1 label-sm md:text-sm lg:text-base">{{$listPro->quantity }}</p>
 
               </div>
               <div class="pl-2">
                 <p class="text-xs md:text-sm  font-normal h-5 md:h-10">{{$listPro->description}}</p>
               </div>
 
               <div class="mt-2 md:mt-0 pl-2">
                <span class="text-xs font-normal line-through text-[#9B9B9B]">{{number_format($listPro->price, 0, ',', '.')}}đ</span>
                <span class="font-medium">{{number_format( $listPro->discount_price, 0, ',', '.')}}đ</span>
               </div>
              </div>
            
          </div>
        </a>
        @endforeach
        <!-- end item -->
        
 
        
        </div>
        {{-- end product --}}

        <div class=" md:flex md:mt-20">
          <div class="flex flex-col items-center mr-3">

            <p class="mt-20 text-center berkshire-swash-regular text-2xl md:mt-0 md:text-4xl lg:text-6xl ">Khám Phá</p>
        <p class="inline-block mt-1 text-center text-xl vujahday-script-regular md:text-3xl lg:text-4xl lg:mt-5">Thực đơn của chúng tôi</p>

    <p class="mt-1 text-center open-sans  text-sm md:text-base md:font-normal lg:text-lg lg:mt-5 ">Discover our wood-fired Neapolitan pizzas, Belgian beers and freshly
         made desserts that you can enjoy in our 2 locations or at home with our quick delivery service.
    </p>
    <a href=""><button class="mt-2 px-7 py-1 text-white text-sm bg-[#D30A0A] rounded font-semibold md:text-base md:px-8 md:py-2 lg:px-12 lg:text-lg lg:mt-5">Đặt Ngay</button></a>
    <p class=" mt-3 text-center text-xs  open-sans md:text-base lg:text-lg">
        Lunch service: <br>
        11am to 3pm <br>
        Dinner service: <br>
        5pm to 10pm <br>
         Please note that last order is 30 minutes before closing time
    </p>
          </div>

      <div class="mt-3 md:max-w-[360px] md:max-h-[360px] lg:max-w-[450px] lg:max-h-[450px]">
        <img src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}" class="h-full w-full rounded-lg object-cover" alt="">
      </div>

        </div>



        <div class=" md:flex mt-8 md:mt-20 md:flex-row-reverse">
          <div class="flex flex-col items-center mr-3 md:mr-0 md:ml-3">

        <p class="inline-block mt-1 text-center text-xl  vujahday-script-regular md:font-semibold md:text-4xl md:mb-4 lg:text-6xl lg:mt-5">Câu chuyện của chúng tôi</p>

    <div class="mt-1 text-center open-sans  text-xs md:text-base md:font-normal lg:text-xl lg:mt-5 ">
      <p class="mb-6 lg:mb-8  ">
        Discover our wood-fired Neapolitan pizzas, Belgian beers and freshly made desserts that you can enjoy in  <a href="" class="underline">our 2 locations</a> or at home with <a href="" class="underline">our quick delivery service</a>.
      </p>

      <p class=" lg:mb-5" >
        Pizza Belga is an authentic Neapolitan pizzeria, located in the heart of Hanoi. Our pizzas are baked in a wood-burning oven and generously topped with fresh, natural and carefully selected ingredients.
      </p>

      <p class=" ">
        Discover more <a href="" class="underline">ABOUT US</a> here
      </p>
    </div>
   
   
          </div>

      <div class="grid grid-cols-2 grid-rows-2 gap-x-5 gap-y-3 mt-2 md:max-w-[300px] md:max-h-[300px] lg:max-w-[480px] lg:max-h-[480px]">
        <img src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}" class="h-full w-full rounded-lg object-cover" alt="">
        <img src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}" class="h-full w-full rounded-lg object-cover" alt="">
        <img src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}" class="h-full w-full rounded-lg object-cover" alt="">
        <img src="{{ asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg') }}" class="h-full w-full rounded-lg object-cover" alt="">
      </div>

        </div>



    </div>



  </div>

    
  

@endsection
