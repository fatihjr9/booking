<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center gap-x-4">
            <p class="text-gray-400 leading-tight">{{ __('Dashboard') }}</p>
            <hr class="rotate-45">
            <p class="font-semibold text-gray-800 leading-tight">Edit Classes</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-fit mx-auto">
                <form action="{{ route('admin-seat-update', $seat->id) }}" method="POST" enctype="multipart/form-data" class="p-4 flex flex-col w-96">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col space-y-2 mb-4">
                        <div class="flex flex-col space-y-1">
                            <p>Seat Available</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" placeholder="{{ $seat->seat_left }}" name="seat_left" id="">
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-black text-white py-2 rounded-lg">Add</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
