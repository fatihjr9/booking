@extends('layouts.client')
@section('content')
<style>
    .selected-event {
        background-color: #14262b;
        color: rgb(129 140 248);
       cursor: pointer;
   }
   .selected-date {
        background-color: #14262b;
        color: rgb(129 140 248);
    }
   #event-list li {
        background-color: #14262b;
        color: white;
        margin-bottom: .5rem;
        padding: .5rem 1rem;
        border-radius: .5rem;
        border: 1px solid #c0c0c0;
        cursor: pointer;
   }
   #event-list li:hover {    
    background-color: #14262b;
    color: rgb(129 140 248);
   }
   </style>
        {{-- Step 1 --}}
        <form action="{{ route('client-create') }}" method="GET" id="step1" class="bg-[#09150f] p-2 rounded-2xl space-y-2 border-l border-slate-700">
            @csrf
            <div id='calendar' data-selected-time="{{ $selectedTime }}" class="w-full lg:h-96 overflow-auto"></div>
            <div id="event-list-container">
                <h3 class="text-white text-xl font-bold mt-4 mb-2">Event List</h3>
                <ul id="event-list" class="grid grid-cols-1 lg:grid-cols-3 gap-1"></ul>
            </div>            
            <button type="button" onclick="nextStep(2)" class="w-full py-2 rounded-lg text-white bg-[#14262b] text-sm font-medium">
                Next                                      
            </button>
        </form>
        {{-- Step 2 --}}
        <form action="{{ route('client-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <section id="step2" style="display: none;" class=" bg-[#09150f] p-4 space-y-4  lg:border-l lg:border-slate-700 rounded-2xl h-96">
                <div class="flex flex-col space-y-0.5">
                    <h5 class="text-xl font-bold mb-2 text-white">Would you prefer a charter or ride share?</h5>
                    <select class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg" id="package-selection" name="packages">
                        <option value="Charter Package (Up to 8 people)" data-item="1">Charter Package (Up to 8 people)</option>
                        <option value="RIDE SHARE (Up to 8 people)" data-item="2">Ride Share (Up to 8 people)</option>
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
            <section id="step3" style="display: none;" class="bg-[#09150f] p-4 lg:border-l lg:border-slate-700 rounded-2xl h-full">
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
                        @if ( $item->category !== 'PUB CRAWL PACKAGE' || $item->category !== 'NON ALCOHOL PACKAGE')
                            <div class="menu-item flex flex-row items-center justify-between mb-2 gap-4" data-category="{{ $item->category === 'CHARTER PACKAGE' ? '1' : '' }}">
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
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    @foreach ($menu as $item)
                    @if ($item->category === 'EXTRA Orders')
                        @if ( $item->category !== 'PUB CRAWL PACKAGE' || $item->category !== 'NON ALCOHOL PACKAGE' || $item->category !== 'CHARTER PACKAGE')
                            <div class="extra-order flex flex-row items-center justify-between mb-2 gap-4">
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
                        <input class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg w-full" type="tel" name="birthday" id="phone">            
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium text-white">Special Request</p>
                        <textarea class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg" type="text" name="request" id=""></textarea>
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium text-white">Total</p>
                        <input class="bg-[#0d1818] py-2 border border-gray-700 text-white text-sm rounded-lg" type="text" readonly name="amount" id="">
                    </div>
                </div>
                <div class="flex flex-row gap-2 mt-4 w-11/12">
                    <input class="bg-[#0d1818]" type="checkbox" name="agreement" value="I Agree with terms and condition">
                    <p class="text-justify text-xs text-gray-500">I Agree with all <a href="{{ route('client-agree') }}" class="underline" target="_blank"> terms and condition</a></p>
                </div>
                <div class="flex flex-row items-center gap-x-2 mt-4">
                    <button type="button" onclick="prevStep(3)" class="w-full py-2 rounded-lg text-slate-600 bg-[#0d1818] text-sm font-medium">
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
            document.querySelectorAll('.extra-order').forEach(item => {
        const checkbox = item.querySelector('.menu-checkbox');
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
                dateClick: function(info) {
                    // Ambil tanggal yang diklik
                    const clickedDate = info.date;
                    const allDates = document.querySelectorAll('.fc-daygrid-day');
                    allDates.forEach(date => {
                        date.classList.remove('selected-date');
                    });
                    info.dayEl.classList.add('selected-date'); 

                    // Filter acara berdasarkan tanggal yang diklik
                    const clickedDateEvents = events.filter(event => {
                        const eventDate = new Date(event.start);
                        return eventDate.getFullYear() === clickedDate.getFullYear() &&
                               eventDate.getMonth() === clickedDate.getMonth() &&
                               eventDate.getDate() === clickedDate.getDate();
                    });             

                    // Tampilkan daftar acara yang sesuai
                    const eventListContainer = document.getElementById('event-list');
                    eventListContainer.innerHTML = ''; // Kosongkan isi sebelum menambahkan acara baru              

                    if (clickedDateEvents.length > 0) {
                        clickedDateEvents.forEach(event => {
                            const eventItem = document.createElement('li');
                            const eventInfo = document.createElement('span');
                            const startTime = new Date(event.start).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                            eventInfo.textContent = `${startTime} - ${event.title}`;
                            eventItem.appendChild(eventInfo);
                            eventItem.addEventListener('click', function() {
                                handleEventSelection(event);
                            });
                            eventListContainer.appendChild(eventItem);
                        });
                    } else {
                        const noEventItem = document.createElement('li');
                        noEventItem.textContent = 'No events for this date';
                        eventListContainer.appendChild(noEventItem);
                    }
                }
            });             

            calendar.render();      

            let selectedEvent = null; // variabel untuk menyimpan event yang dipilih sebelumnya     

            function handleEventSelection(event) {
                // Tangani pemilihan acara
                const options = {locale:'en-US', weekday: 'long', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
                const selectedTime = new Intl.DateTimeFormat('en-US', options).format(new Date(event.start));
                document.getElementById('book_time').value = selectedTime;      

                // Hapus kelas selected-event dari event sebelumnya yang dipilih (jika ada)
                if (selectedEvent !== null) {
                    selectedEvent.classList.remove('selected-event');
                }               

                // Tambahkan kelas selected-event pada event yang baru dipilih
                selectedEvent = event.target;
                selectedEvent.classList.add('selected-event');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const packageSelect = document.getElementById('package-selection');
            const charterSection = document.getElementById('charter-selection');
            const charterMenuItems = document.querySelectorAll('.menu-item[data-category="1"]');
            const rideMenuItems = document.querySelectorAll('.menu-item[data-category="2"]');

            // Fungsi untuk menyesuaikan tampilan menu saat pilihan paket berubah
            function adjustMenuDisplay(selectedValue) {
                if (selectedValue === 'Charter Package (Up to 8 people)') {
                    charterSection.style.display = 'block';
                    charterMenuItems.forEach(item => {
                        item.style.display = 'flex';
                    });
                    rideMenuItems.forEach(item => {
                        item.style.display = 'none';
                    });
                } else if (selectedValue === 'RIDE SHARE (Up to 8 people)') {
                    charterSection.style.display = 'none';
                    charterMenuItems.forEach(item => {
                        item.style.display = 'none';
                    });
                    rideMenuItems.forEach(item => {
                        item.style.display = 'flex';
                    });
                } else {
                    // Jika pilihan paket tidak sesuai, sembunyikan semua opsi menu
                    charterSection.style.display = 'none';
                    charterMenuItems.forEach(item => {
                        item.style.display = 'none';
                    });
                    rideMenuItems.forEach(item => {
                        item.style.display = 'none';
                    });
                }
            }

            // Panggil fungsi untuk menyesuaikan tampilan menu saat halaman dimuat
            adjustMenuDisplay(packageSelect.value);

            // Tambahkan event listener untuk memanggil fungsi saat pilihan paket berubah
            packageSelect.addEventListener('change', function() {
                adjustMenuDisplay(this.value);
            });
        });


    </script>
@endsection