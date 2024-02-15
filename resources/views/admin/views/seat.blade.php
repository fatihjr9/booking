<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Seats') }}
            </h2>
            <a href="{{ route('admin-seat-create') }}">Add Seat</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($grouped as $date => $seatsByDate)
                    <div class="bg-white p-4 rounded-lg space-y-2 md:space-y-6">
                        <h2 class="font-bold text-sm md:text-lg">{{ $date }}</h2>
                        <div class="grid grid-cols-2">
                            @foreach ($seatsByDate as $seat)
                                <div class="flex flex-row items-center gap-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>                              
                                    <h5 class="text-sm">{{ $seat->available_time }}</h5>
                                </div>
                                <div class="flex flex-row items-center gap-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>                                                               
                                    <h5 class="text-sm">{{ $seat->seat_left }} Seats</h5>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach          
            </div>
        </div>
    </div>
</x-app-layout>