@extends('layouts.client')
@section('content')
    <style>
       #myModal {
        display: none; /* Sembunyikan modal secara default */
    }
    </style>
    <div class="bg-white p-4 md:w-8/12 mx-auto border rounded-md">
        <h5 class="border-b pb-2 text-xl font-semibold">Reservation</h5>
        <div class="flex flex-col space-y-0.5 my-2 border-b pb-4">
            <p class="text-sm font-medium">Booking Time</p>
            <form action="{{ route('client-create') }}" method="GET">
                @csrf
                <div class="grid grid-cols-2 items-center gap-x-2">
                    <div class="bg-gray-50 flex justify-between py-1.5 border border-gray-300 text-gray-900 text-xs rounded-lg">
                        <input type="date" name="book_date" class="border-none bg-transparent text-sm py-0.5" id="" value="{{ session('selected_date') }}">
                        <button type="submit" class="text-sm mr-2 bg-orange-600 text-orange-100 p-1 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>                                      
                        </button>
                    </div>
                    <select class="bg-gray-50 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg" name="book_time" id="">
                        @foreach($seats as $seat)
                            <option value="{{ $seat->available_time }}" {{ $selectedTime == $seat->available_time ? 'selected' : '' }}>{{ $seat->available_time }} - {{ $seat->seat_left }} seat left</option>
                        @endforeach
                    </select>
                </div>
            </form>            
        </div> 
        <form action="{{ route('client-store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
            @csrf
            <div class="grid grid-cols-2 gap-4 mb-4">
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
                    <p class="text-sm font-medium">Menu</p>
                    <div onclick="openModal()" class="bg-gray-50 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg text-center cursor-pointer">Choose Menu - 4 Items selected</div>
                    <div id="myModal" class="bg-black/50 fixed z-20 inset-0 w-full h-screen">
                        <div class="md:w-8/12 rounded-md bg-white mx-auto mt-20">
                            <div class="flex flex-row items-center justify-between px-8 py-4 text-center border-b shadow-sm">
                                <h5 class="text-xl font-bold">Choose Menu</h5>
                                <div class="text-xl font-bold cursor-pointer" onclick="closeModal()">x</div>
                            </div>
                            <div class="h-80 overflow-y-scroll p-2">
                                <div class="grid grid-cols-1 gap-y-2 p-2">
                                    @foreach ($menu as $item)
                                        <div class="menu-item flex flex-row items-center justify-between border-b pb-2 mb-2">
                                            <div class="flex flex-row items-center gap-x-4">
                                                <input type="checkbox" class="menu-checkbox border border-gray-600 rounded-sm" name="menu[]" id="menu-{{ $item->id }}" value="{{ $item->name }}">
                                                <div class="flex flex-col gap-y-2">
                                                    <div class="flex flex-col">
                                                        <h5 class="font-semibold text-lg">{{ $item->name }}</h5>
                                                        <p class="text-gray-700">{{ $item->description }}</p>
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
                            <div class="border-t shadow-sm py-4 flex flex-row items-center justify-between px-6">
                                <h5 class="text-lg text-gray-600">Total Price</h5>
                                <h5 id="total-price" class="text-lg font-bold">Rp 0</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col space-y-0.5">
                    <p class="text-sm font-medium">Payment Method</p>
                    <select name="payment" id="" class="bg-gray-50 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg">
                        <option value="Local Bank">Local Bank</option>
                        {{-- <option value="Paypal">Paypal</option> --}}
                        <option value="Cash">Cash</option>
                    </select>
                </div>
                <div class="flex flex-col space-y-0.5">
                    <p class="text-sm font-medium">Affiliate ( optional )</p>
                    <input class="bg-gray-50 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="affiliate" id="">
                </div>
                <div class="flex flex-col space-y-0.5">
                    <p class="text-sm font-medium">Total</p>
                    <input class="bg-gray-50 py-2 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" readonly name="amount" id="">
                </div>
            </div>
            <button type="submit" class="w-full py-2 rounded-lg text-white bg-black text-sm">Book Now</button>
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
        
    </script>
@endsection