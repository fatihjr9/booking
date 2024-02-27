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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-fit mx-auto">
                <form action="{{ route('admin-seat-store') }}" method="POST" enctype="multipart/form-data" class="p-4 flex flex-col w-96">
                    @csrf
                    <div class="flex flex-col space-y-2 mb-4">
                        <div class="flex flex-col space-y-1">
                            <p>Date and Time</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="datetime-local" name="available_time" id="">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Seats Available</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="number" name="seat_left" id="">
                        </div>
                    </div>
                    <button class="w-full bg-black text-white py-2 rounded-lg">Add</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Select the dropdown element
            var statusDropdown = document.getElementById('category');
            // Select the input element for seats availability
            var seatsInputContainer = document.getElementById('seatsInputContainer');
            var seatsInput = document.getElementById('seat_left');
            
            // Add event listener to the dropdown
            statusDropdown.addEventListener('change', function () {
                // Check if the selected option is "Active"
                if (statusDropdown.value === 'Active') {
                    // Display the seats input
                    seatsInputContainer.style.display = 'block';
                } else {
                    // Hide the seats input
                    seatsInputContainer.style.display = 'none';
                }
            });

            // Initially hide or show seats input based on the default selected value
            if (statusDropdown.value === 'Active') {
                seatsInputContainer.style.display = 'block';
            } else {
                seatsInputContainer.style.display = 'none';
            }
        });
    </script>
</x-app-layout>
