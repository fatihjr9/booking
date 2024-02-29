@extends('layouts.client')
@section('content')
        {{-- Step 1 --}}
        <form action="{{ route('client-create') }}" method="GET" id="step1" class="bg-[#09150f] p-2 rounded-2xl space-y-2 border-l border-slate-700">
            @csrf
            <div id='calendar' data-selected-time="{{ $selectedTime }}"></div>
            <button type="button" onclick="nextStep(2)" class="w-full py-2 rounded-lg text-white bg-[#14262b] text-sm font-medium">
                Next                                      
            </button>
        </form>
        {{-- Step 2 --}}
        <form action="{{ route('client-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <section id="step2" style="display: none;" class=" bg-[#09150f] p-4 space-y-4  border-l border-slate-700 rounded-2xl h-screen">
                <div class="flex flex-col space-y-0.5">
                    <h5 class="text-xl font-bold mb-2 text-white">Would you prefer a charter or ride share?</h5>
                    <select class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg" id="package-selection">
                        <option value="charter" data-item="1">Charter Package</option>
                        <option value="ride" data-item="2">ride Package</option>
                    </select>
                </div>
                <div class="flex flex-row items-center gap-x-2">
                    <button type="button" onclick="prevStep(1)" class="w-full py-2 rounded-lg text-slate-600 bg-[#0d1818] text-sm font-medium">
                        Back
                    </button>
                    <button type="button" onclick="nextStep(3)" class="w-full py-2 rounded-lg text-white bg-[#14262b] text-sm font-medium">
                        Next                                      
                    </button>
                </div>
            </section>
            <section id="step3" style="display: none;" class="bg-[#09150f] p-4  border-l border-slate-700 rounded-2xl">
                <div class="flex flex-col space-y-2" id="charter-selection">
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium text-white">How much person?</p>
                        <select class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg" name="person" id="">
                            <x-person/>
                        </select>            
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium text-white">Let me know if you have party name</p>
                        <input class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg" type="text" name="party" id="">          
                    </div>
                </div>
                <h5 class="text-xl font-bold mb-2 text-white">Packages</h5>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        @foreach ($menu as $item)
                        @if ($item->category === 'CHARTER PACKAGE')
                            <div class="menu-item flex flex-row items-center justify-between mb-2 gap-4" data-category="{{ $item->category === 'CHARTER PACKAGE' && $item->category !== 'PUB CRAWL PACKAGE' || $item->category !== 'NON ALCOHOL PACKAGE' ? '1' : '' }}">
                                <div class="flex flex-row items-center gap-x-4">
                                    <input type="checkbox" class="menu-checkbox border border-gray-600 bg-white rounded-sm" name="menu[]" id="menu-{{ $item->id }}" value="{{ $item->name }}">
                                    <div class="flex flex-col gap-y-2">
                                        <div class="flex flex-col">
                                            <h5 class="font-semibold text-base text-white">{{ $item->name }}</h5>
                                            <h5 class="font-semibold text-xs px-2 py-1 bg-slate-900 text-indigo-400 w-fit rounded-md">{{ $item->category }}</h5>
                                            <p class="text-gray-400 text-sm text-justify">{{ $item->description }}</p>
                                        </div>
                                        <h5 class="menu-price font-semibold text-green-500">{{ Number::currency($item->price, 'IDR') }}</h5>
                                    </div>
                                </div>
                                <input type="number" class="quantity-input w-20 border border-gray-700 rounded-lg" name="quantity[]" id="quantity-{{ $item->id }}" min="1" placeholder="1">
                                <input type="hidden" name="menu_ids[]" value="{{ $item->id }}">
                            </div>
                        @elseif ($item->category === 'PUB CRAWL PACKAGE' || $item->category === 'NON ALCOHOL PACKAGE')
                            @if ($item->category !== 'CHARTER PACKAGE')
                                <div class="menu-item flex flex-row items-center justify-between mb-2 gap-4" data-category="{{ $item->category === 'PUB CRAWL PACKAGE' || $item->category === 'NON ALCOHOL PACKAGE' ? '2' : '' }}">
                                    <div class="flex flex-row items-center gap-x-4">
                                        <input type="checkbox" class="menu-checkbox border border-gray-600 bg-white rounded-sm" name="menu[]" id="menu-{{ $item->id }}" value="{{ $item->name }}">
                                        <div class="flex flex-col gap-y-2">
                                            <div class="flex flex-col">
                                                <h5 class="font-semibold text-base text-white">{{ $item->name }}</h5>
                                                <h5 class="font-semibold text-xs px-2 py-1 bg-slate-900 text-indigo-400 w-fit rounded-md">{{ $item->category }}</h5>
                                                <p class="text-gray-400 text-sm text-justify">{{ $item->description }}</p>
                                            </div>
                                            <h5 class="menu-price font-semibold text-green-500">{{ Number::currency($item->price, 'IDR') }}</h5>
                                        </div>
                                    </div>
                                    <input type="number" class="quantity-input w-20 border border-gray-700 rounded-lg" name="quantity[]" id="quantity-{{ $item->id }}" min="1" placeholder="1">
                                    <input type="hidden" name="menu_ids[]" value="{{ $item->id }}">
                                </div>
                            @endif
                        @endif
                    @endforeach
                    
                    </div>
                <div class="flex flex-row items-center gap-x-2">
                    <button type="button" onclick="prevStep(2)" class="w-full py-2 rounded-lg text-slate-600 bg-[#0d1818] text-sm font-medium">
                        Back
                    </button>
                    <button type="button" onclick="nextStep(4)" class="w-full py-2 rounded-lg text-white bg-[#14262b] text-sm font-medium">
                        Next                                      
                    </button>
                </div>
            </section>
            <section id="step4" style="display: none;" class="bg-[#09150f] p-4  border-l border-slate-700 rounded-2xl">
                <h5 class="text-xl font-bold mb-2 text-white">Extra Orders</h5>
                <div class="flex flex-row items-start justify-between">
                    <div class="grid grid-cols-1 items-start">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            @foreach ($menu as $item)
                            @if ($item->category === 'EXTRA Orders')
                                <div class="flex flex-row items-center justify-between mb-2 gap-4">
                                    <div class="menu-item flex flex-row items-center gap-x-4">
                                        <input type="checkbox" class="menu-checkbox border border-gray-600 bg-white rounded-sm" name="menu[]" id="menu-{{ $item->id }}" value="{{ $item->name }}">
                                        <div class="flex flex-col gap-y-2">
                                            <div class="flex flex-col">
                                                <h5 class="font-semibold text-base text-white">{{ $item->name }}</h5>
                                                <h5 class="font-semibold text-xs px-2 py-1 bg-slate-900 text-indigo-400 w-fit rounded-md">{{ $item->category }}</h5>
                                                <p class="text-gray-400 text-sm text-justify">{{ $item->description }}</p>
                                            </div>
                                            <h5 class="menu-price font-semibold text-green-500">{{ Number::currency($item->price, 'IDR') }}</h5>
                                        </div>
                                    </div>
                                    <input type="number" class="quantity-input w-20 border border-gray-700 rounded-lg" name="quantity[]" id="quantity-{{ $item->id }}" min="1" placeholder="1">
                                    <input type="hidden" name="menu_ids[]" value="{{ $item->id }}">
                                </div>
                            @endif
                        @endforeach
                        
                        </div>
                    </div>
                </div>
                <div class="flex flex-row items-center gap-x-2 mt-4">
                    <button type="button" onclick="prevStep(3)" class="w-full py-2 rounded-lg text-slate-600 bg-[#0d1818] text-sm font-medium">
                        Back
                    </button>

                    <button type="button" onclick="nextStep(5)" class="w-full py-2 rounded-lg text-white bg-[#14262b] text-sm font-medium">
                        Next                                      
                    </button>                
                </div>
            </section>
            <section id="step5" style="display: none;" class="bg-[#09150f] p-4  border-l border-slate-700 rounded-2xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium text-white">Name</p>
                        <input class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg" type="text" name="name" id="">
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium text-white">Email</p>
                        <input class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg" type="email" name="email" id="">
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium text-white">Country</p>
                        <select class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg" name="country" id="">
                            <x-country/>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium text-white">Phone</p>
                        <input class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg w-full" type="tel" name="phone" id="phone">
                    </div>
                    <input class="hidden" readonly name="book_time" id="book_time" value="{{ $selectedTime }}">
                    <input class="hidden" readonly name="affiliate">
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium text-white">If you have a birthday person, please let us know his/her age and name.</p>
                        <input class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg w-full" type="tel" name="phone" id="phone">            
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium text-white">Special Request</p>
                        <textarea class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg" type="text" name="birthday" id=""></textarea>
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium text-white">Total</p>
                        <input class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg" type="text" readonly name="amount" id="">
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium text-white">Payment Method</p>
                        <select name="payment" id="" class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg">
                            <option value="Local Bank">Local Bank</option>
                            <option value="Paypal">Paypal</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col gap-y-2 mt-2 w-11/12">
                    <div class="flex flex-row items-center gap-x-2">
                        <input class="bg-[#0d1818]" type="checkbox" id="">
                        <p class="text-justify text-xs text-gray-500">We are in good health and have not received any medical treatment from a physician or other health care provider for any illness or condition that would interfere with the operation of BEER SHIP PUB CRAWL.</p>
                    </div>
                    <div class="flex flex-row items-center gap-x-2">
                        <input class="bg-[#0d1818]" type="checkbox" id="">
                        <p class="text-justify text-xs text-gray-500">We will always fasten our seatbelts and pledge not to get drunk.</p>
                    </div>
                    <div class="flex flex-row items-center gap-x-2">
                        <input class="bg-[#0d1818]" type="checkbox" id="">
                        <p class="text-justify text-xs text-gray-500">We are responsible for any defacement or loss of clothing, jewelry or personal belongings.</p>
                    </div>
                    <div class="flex flex-row items-center gap-x-2">
                        <input class="bg-[#0d1818]" type="checkbox" id="">
                        <p class="text-justify text-xs text-gray-500">Any injuries or accidents resulting from failure to follow BEER SHIP PUB CRAWL rules and staff instructions are our own responsibility, and we will not make any claims for refunds or damages in this case.</p>
                    </div>
                    <div class="flex flex-row items-center gap-x-2">
                        <input class="bg-[#0d1818]" type="checkbox" id="">
                        <p class="text-justify text-xs text-gray-500">We acknowledge that we cannot cancel after payment. *It is possible to change the date within 2 years.</p>
                    </div>
                    <div class="flex flex-row items-center gap-x-2">
                        <input class="bg-[#0d1818]" type="checkbox" id="">
                        <p class="text-justify text-xs text-gray-500">We promise to be at the meeting place, SHIPWRECK BALI ROOFTOP BAR & RESTO, at least 15 minutes before the meeting.</p>
                    </div>
                </div>
                <div class="flex flex-row items-center gap-x-2 mt-4">
                    <button type="button" onclick="prevStep(4)" class="w-full py-2 rounded-lg text-slate-600 bg-[#0d1818] text-sm font-medium">
                        Back
                    </button>
                    <button type="submit" class="w-full py-2 rounded-lg text-white bg-[#14262b] text-sm font-medium">Confirm</button>
                </div>
            </section>
        </form>
    <script>
        // update price
        function updateTotalPrice() {
            let totalPrice = 0;
            document.querySelectorAll('.menu-item').forEach(item => {
                const checkbox = item.querySelector('input[type="checkbox"]');
                const quantityInput = item.querySelector('.quantity-input');
                if (checkbox.checked && quantityInput.value !== '') {
                    const price = parseFloat(item.querySelector('.menu-price').innerText.replace(/[^\d.]/g, ''));
                    const quantity = parseInt(quantityInput.value);
                    totalPrice += price * quantity;
                }
            });
            const amountInput = document.querySelector('input[name="amount"]');
            amountInput.value = totalPrice.toFixed(2);
            document.getElementById('total-price').innerText = 'Rp ' + (totalPrice || 0).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.menu-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateTotalPrice();
                });
            });
        
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('input', function() {
                    updateTotalPrice();
                });
            });
        });

        function openModal() {
            document.getElementById('myModal').style.display = 'block';
        }       

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Menandai radio button yang dipilih sebagai 'active'
                this.closest('form').querySelectorAll('label').forEach(label => {
                    label.classList.remove('active');
                });
                this.parentElement.classList.add('active');
                
                // Submit form
                this.closest('form').submit();
            });
        });
        // stepper
        let currentStep = 1;

        function nextStep(step) {
            // Set session value based on user selection
            const selectedValue = document.getElementById('package-selection').value;
            sessionStorage.setItem('selectedPackage', selectedValue);       

            // Proceed to next step
            document.getElementById('step' + currentStep).style.display = 'none';
            document.getElementById('step' + step).style.display = 'block';
            currentStep = step;
        }

        function prevStep(step) {
            // Remove session value when going back
            sessionStorage.removeItem('selectedPackage');       

            // Go back to previous step
            document.getElementById('step' + currentStep).style.display = 'none';
            document.getElementById('step' + step).style.display = 'block';
            currentStep = step;
        }

        // Calendar load
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const events = {!! json_encode($events) !!};        

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: events,
                eventClick: function(info) {
                    const selectedTime = info.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    document.getElementById('book_time').value = selectedTime;      

                    // Menandai elemen yang diklik sebagai aktif
                    const allEvents = document.querySelectorAll('.fc-event');
                    allEvents.forEach(eventEl => {
                        eventEl.classList.remove('active');
                        eventEl.style.cursor = 'auto'; // Mengembalikan kursor ke nilai default
                    });
                    info.el.classList.add('active');
                    info.el.style.cursor = 'pointer'; // Mengatur kursor menjadi pointer
                }
            });
            calendar.render();
        });
        document.addEventListener('DOMContentLoaded', function() {
    const packageSelect = document.getElementById('package-selection');
    const charterSection = document.getElementById('charter-selection');
    const charterMenuItems = document.querySelectorAll('.menu-item[data-category="1"]');
    const rideMenuItems = document.querySelectorAll('.menu-item[data-category="2"]');

    packageSelect.addEventListener('change', function() {
        const selectedValue = packageSelect.value;

        // Menampilkan atau menyembunyikan section charter selection sesuai dengan value yang dipilih
        charterSection.style.display = (selectedValue === 'charter') ? 'block' : 'none';

        // Menampilkan atau menyembunyikan menu item sesuai dengan value yang dipilih
        if (selectedValue === 'charter') {
            charterMenuItems.forEach(item => {
                item.style.display = 'flex';
            });
            rideMenuItems.forEach(item => {
                item.style.display = 'none';
            });
        } else {
            charterMenuItems.forEach(item => {
                item.style.display = 'none';
            });
            rideMenuItems.forEach(item => {
                item.style.display = 'flex';
            });
        }
    });
});

    </script>
@endsection