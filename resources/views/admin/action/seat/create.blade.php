<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center gap-x-4">
            <p class="text-gray-400 leading-tight">{{ __('Dashboard') }}</p>
            <hr class="rotate-45">
            <p class="font-semibold text-gray-800 leading-tight">Add Seats</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-8/12 mx-auto">
                <form action="{{ route('admin-seat-store') }}" method="POST" enctype="multipart/form-data" class="p-4 w-full">
                    @csrf
                    <div class="flex flex-col gap-2" id="inputContainer">
                        <div class="flex flex-col space-y-1">
                            <p>Date and Time</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" type="datetime-local" name="available_time[]" required>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Seats Available</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" type="number" name="seat_left[]" required>
                        </div>
                    </div>                  
                    <button type="button" onclick="addMoreInputs()" class="w-full bg-slate-100 text-slate-400 py-2 rounded-lg my-2">+ Add time and seat</button>
                    <button class="w-full bg-black text-white py-2 rounded-lg">Continue</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function addMoreInputs() {
            var container = document.getElementById('inputContainer');

            var dateTimeInput = document.createElement('div');
            dateTimeInput.className = 'flex flex-col space-y-1';
            dateTimeInput.innerHTML = '<p>Date and Time</p><input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="datetime-local" name="available_time[]" required>';

            var seatsInput = document.createElement('div');
            seatsInput.className = 'flex flex-col space-y-1';
            seatsInput.innerHTML = '<p>Seats Available</p><input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="number" name="seat_left[]" required>';

            container.appendChild(dateTimeInput);
            container.appendChild(seatsInput);
        }
    </script>
</x-app-layout>
