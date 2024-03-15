<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Pubcrawl</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.16/build/css/intlTelInput.css">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-[#080d07]">
        <div class="p-4">
            <div class="bg-[#0d1818] lg:border border-slate-700 rounded-xl">
                <div class="flex flex-col lg:flex-row gap-4">
                    <div class="flex flex-col lg:justify-between lg:w-96 p-4 mx-auto lg:ml-auto">
                        <img class="object-cover bg-center rounded-2xl" src="{{ asset('/pub.jpeg') }}" alt="">
                        <div class="flex flex-col space-y-2 mt-6 lg:mt-0">
                            <p class="text-justify text-xs text-red-400 font-bold">
                                If you wish to use CASH, BANK WIRE, QRIS, or any kind of e-money, you cannot apply online. Please come directly to SHIPWRECK BALI ROOFTOP BAR &RESTO.
                            </p>
                            <p class="text-justify text-xs text-gray-400 font-medium">
                                We offer you a special moment in Bali with your family and friends. 
                                We operate SHIPWRECK BALI ROOFTOP BAR near the airport. 
                                We will pass along the famous Kuta Beach in the Kuta and Legian areas, through the Beach Walk Shopping Mall, and along the busiest Legian Street.
                                Amidst the many tourists, you will all be able to see your surroundings from a vehicle one level higher and enjoy yourself with the best music and drinks.
                                Enjoy about 90〜120minutes of Beer Ship Pub Crawl.
                            </p>
                            <p class="text-justify text-xs text-gray-400 mt-2">
                                ※Safety regulations allow passengers 10 years of age and older.
                            </p>
                        </div>
                    </div>
                    <main class="w-full bg-[#09150f] lg:border-l lg:border-slate-700 lg:rounded-2xl">
                        @yield('content')
                    </main>
                </div>                                   
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.16/build/js/intlTelInput.min.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
        
        <script>
            const input = document.querySelector("#phone");
            const iti = window.intlTelInput(input, {
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.16/build/js/utils.js"
            });

            input.addEventListener('countrychange', function (e) {
                const countryCode = iti.getSelectedCountryData().dialCode; // Mendapatkan kode panggilan negara
                const phoneNumber = input.value.replace(/\D/g, ''); // Menghapus karakter non-digit dari nomor telepon
                input.value = `+${countryCode}${phoneNumber}`; // Memperbarui nilai input dengan nomor telepon yang diformat
            });
        </script>
    </body>
</html>
