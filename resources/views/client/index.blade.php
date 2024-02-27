@extends('layouts.client')
@section('content')

    <div class="bg-white p-4 md:w-8/12 mx-auto border rounded-md">
        {{-- <h5 class="border-b pb-2 text-xl font-semibold">Reservation</h5> --}}
        {{-- Step 1 --}}
        <form action="{{ route('client-create') }}" method="GET" id="step1">
            @csrf
            <div id='calendar'></div>
            <button type="button" onclick="nextStep(2)" class="w-full py-2 rounded-lg text-white bg-black text-sm">
                Next                                      
            </button>
        </form>
        {{-- Step 2 --}}
        <form action="{{ route('client-store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
            @csrf
            <section id="step2" style="display: none;">
                <div class="h-[28rem] overflow-y-auto grid grid-cols-1 items-start">
                    <div class="grid grid-cols-1 gap-y-2">
                        <h5 class="text-xl font-bold mb-2">Packages</h5>
                        @foreach ($menu as $item)
                            <div class="menu-item flex flex-row items-center justify-between mb-2 gap-4">
                                <div class="flex flex-row items-center gap-x-4">
                                    <input type="checkbox" class="menu-checkbox border border-gray-600 rounded-sm" name="menu[]" id="menu-{{ $item->id }}" value="{{ $item->name }}">
                                    <div class="flex flex-col gap-y-2">
                                        <div class="flex flex-col">
                                            <h5 class="font-semibold text-base">{{ $item->name }}</h5>
                                            <h5 class="font-semibold text-xs px-2 py-1 bg-indigo-50 text-indigo-500 w-fit rounded-md">{{ $item->category }}</h5>
                                            <p class="text-gray-700 text-sm text-justify">{{ $item->description }}</p>
                                        </div>
                                        <h5 class="menu-price font-semibold text-green-500">{{ Number::currency($item->price, 'IDR') }}</h5>
                                    </div>
                                </div>
                                <input type="number" class="quantity-input w-20 border border-gray-300 rounded-lg" name="quantity[]" id="quantity-{{ $item->id }}" min="1" placeholder="1">
                                <input type="hidden" name="menu_ids[]" value="{{ $item->id }}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-col space-y-0.5 py-4">
                    <p class="text-sm font-medium">Total</p>
                    <input class="bg-gray-50 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" readonly name="amount" id="">
                </div>
                <div class="flex flex-row items-center gap-x-2">
                    <button type="button" onclick="prevStep(1)" class="w-full py-2 rounded-lg text-black bg-slate-200 text-sm">
                        Back
                    </button>
                    <button type="button" onclick="nextStep(3)" class="w-full py-2 rounded-lg text-white bg-black text-sm">
                        Next                                      
                    </button>
                </div>
            </section>
            <section id="step3" style="display: none;">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium">Name</p>
                        <input class="bg-gray-50 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="name" id="">
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium">Email</p>
                        <input class="bg-gray-50 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg" type="email" name="email" id="">
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium">Country</p>
                        <select class="bg-gray-50 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg" name="country" id="">
                            <x-country/>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium">Phone</p>
                        <input class="bg-gray-50 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" type="tel" name="phone" id="phone">
                    </div>
                    <input type="text" class="hidden" readonly name="book_date" value="{{ session('selected_date') }}">
                    <input type="text" class="hidden" readonly name="book_time" value="{{ session('selected_time') }}">               
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium">How much person?</p>
                        <select class="bg-gray-50 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg" name="person" id="">
                            <x-person/>
                        </select>            
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium">Payment Method</p>
                        <select name="payment" id="" class="bg-gray-50 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg">
                            <option value="Local Bank">Local Bank</option>
                            <option value="Paypal">Paypal</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-0.5">
                        <p class="text-sm font-medium">Special Request</p>
                        <input class="bg-gray-50 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="affiliate" id="">
                    </div>
                </div>
                <div class="flex flex-row items-center gap-x-2 mt-4">
                    <button type="button" onclick="prevStep(2)" class="w-full py-2 rounded-lg text-black bg-slate-200 text-sm">
                        Back
                    </button>
                    {{-- <button type="button" onclick="nextStep(4)">
                        Next                                      
                    </button> --}}
                    <button type="submit" class="w-full py-2 rounded-lg text-white bg-black text-sm">Order now</button>
                </div>
            </section>
        </form>
    </div>
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
            document.getElementById('step' + currentStep).style.display = 'none';
            document.getElementById('step' + step).style.display = 'block';
            currentStep = step;
        }
        function prevStep(step) {
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
            });
            calendar.render();
        });
    </script>
@endsection