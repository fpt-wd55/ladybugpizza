@extends('layouts.client')

@section('title', 'Về chúng tôi')

@section('content')
    <div class="w-full">
        <img class=" w-full object-cover" src=" {{ asset('storage/uploads/banners/banner.jpg') }}" alt="">
    </div>
    <div class="container w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4 transition">
        <div class="w-full">
            {{-- decscription --}}
            <div class="mt-6 text-center">
                <h1 class="  text-5xl font-medium">About Ladybugs Pizza</h1>
                <p class=" text-md mt-12 ">Located in the heart of Savannah’s Starland district in the Starland
                    Yard complex, Pizzeria Vittoria is a Neapolitan-inspired pizzeria showcasing naturally-leavened pizza
                    from chef/owner Kyle Jacovino (The Florence, Five & Ten). At Vittoria, Jacovino draws from his nearly
                    two decades of culinary experience and Italian-American heritage to craft pizzas that are an expression
                    of regionality and his commitment to the Slow Food Movement.
                </p>
                <p class=" text-md mt-12">
                    Meticulously crafted with local organic grains sourced from regional millers such as Anson Mills and
                    Lindley Mills, Jacovino’s prized dough ferments for up to 48 hours before being fired in a hand-built
                    Neapolitan Giovanni Acunto brick oven. Baked for 90 seconds between 800 and 825 degrees.
                </p>
                <p class=" text-md mt-12">
                    A focal point within the Starland Yard, Vittoria is the only brick-and-mortar space within the complex,
                    conceptualized as a food truck park. Constructed out of a shipping container, the restaurant is a
                    functional canvas for Jacovino’s talent and craft, mirroring the surrounding community’s creative
                    culture. When operational, an adjacent patio invites guests to linger, sharing pies and tipping back
                    glasses of wine and beer.
                </p>
                <h2 class="mt-12  text-6xl vujahday-script-regular">Ladybugs Pizza</h2>
                <p class="mt-12 font-medium text-3xl">Hours & Location</p>
                <p>35 Downing Street, <br>
                    New York, NY 10014 <br>
                    917-935-6434
                </p>
                <p>
                    We’re located inside the Starland Yard Park. You can find us right on the corner of 40th and Desoto Ave!
                    Look for our shipping container to the right of the entrance!
                </p>
                <div class="mt-8">
                    <span class="font-medium">Monday - Thursday </span>: 10AM - 8PM <br>
                    <span class="font-medium">Friday</span> : 12PM - 12AM <br>
                    <span class="font-medium">Saturday</span> : 11AM - 12AM <br>
                    <span class="font-medium">Sunday</span> Sunday: 11AM - 10PM
                </div>
            </div>
            <div class="flex justify-center">
                <button class="mt-12 w-36 button-red">Đặt ngay</button>
            </div>
            {{-- decscription --}}
        </div>

        <div class="grid grid-cols-2 mt-10 gap-4">
            <div>
                <img class="rounded-md"  src="{{asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg')}}" alt="">
                <img class="mt-4 rounded-md" src="{{asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg')}}" alt="">
            </div>
            <div>
                <img class="rounded-md" src="{{asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg')}}" alt="">
                <img class="mt-4 rounded-md" src="{{asset('storage/uploads/products/pizza/pizza_pesto_burrata.jpeg')}}" alt="">
            </div>
        </div>
    </div>
@endsection
