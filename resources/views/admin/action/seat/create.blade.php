<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center gap-x-4">
            <p class="text-gray-400 leading-tight">{{ __('Dashboard') }}</p>
            <hr class="rotate-45">
            <p class="font-semibold text-gray-800 leading-tight">Add Seats</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-8/12 mx-auto">
                <form action="{{ route('admin-seat-store') }}" method="POST" enctype="multipart/form-data" class="p-4 w-full">
                    @csrf
                    <div class="flex flex-col gap-2" id="inputContainer">
                        <div class="flex flex-col space-y-1">
                            <p class="text-base font-bold">Date</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" 
                                   type="date" id="available_date" name="available_time">
                            <div id="selected_dates" class="grid grid-cols-2 lg:grid-cols-6 gap-2"></div>
                        </div>
                        @php
                            $timeSlots = ['12:00', '14:30', '17:00', '19:30', '22:00'];
                        @endphp
                        <p class="text-base font-bold">Time And Seats</p>
                        <!-- Loop through time slots and display inputs -->
                        @foreach ($timeSlots as $time)
                            <div class="flex flex-row items-center gap-x-2">
                                <p>{{ $time }}</p>
                                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" type="number" name="seat_left[]" required>
                            </div>
                        @endforeach
                    </div>                  
                    <button class="w-full bg-black text-white py-2 rounded-lg mt-4">Continue</button>
                </form>
            </div>
        </div>
    </div>
<script>
    const inputDate = document.getElementById('available_date');

    inputDate.addEventListener('change', function() {
        const selectedDate = inputDate.value;

        if (selectedDate) {
            // Cek apakah tanggal sudah ada dalam daftar
            const existingDate = document.querySelector(`#selected_dates input[value="${selectedDate}"]`);
            
            if (!existingDate) {
                const newDate = document.createElement('input');
                newDate.classList.add('bg-slate-200', 'text-slate-900', 'px-3','py-1', 'rounded-lg');
                newDate.setAttribute('type', 'date');
                newDate.setAttribute('name', 'available_time[]');
                newDate.setAttribute('value', selectedDate);
                newDate.setAttribute('readonly', 'readonly');
                document.getElementById('selected_dates').appendChild(newDate);
            }
        }

        inputDate.value = ""; // Clear input after adding date
    });
</script>

    
</x-app-layout>
