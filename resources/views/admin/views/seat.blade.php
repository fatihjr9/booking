<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Seats') }}
            </h2>
            <button  id="dropdownHoverButton" class="px-4 py-2 bg-black text-white rounded-lg w-fit" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover">Add Services</button>
            <div id="dropdownHover" class="z-10 hidden bg-white divide-y divide-gray-100 border rounded-lg shadow p-1 w-40 mx-auto">
                <div class="flex flex-col gap-2">
                    <a href="{{ route('admin-seat-create') }}" class="hover:bg-orange-50 hover:text-orange-500 text-sm p-2">Add Menu</a>
                    <a href="{{ route('admin-category-tour-create') }}" class="hover:bg-orange-50 hover:text-orange-500 text-sm p-2">Add Category</a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 md:p-0">
                @foreach ($seats as $item)
                    <div class="bg-white p-4 rounded-lg space-y-2 md:space-y-6">
                        <div class="flex flex-row items-center gap-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>                              
                            <h5 class="text-sm">{{ $item->available_time }}</h5>
                        </div>
                        <div class="flex flex-row items-center gap-x-1 justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>                                                               
                            <h5 class="text-sm">{{ $item->seat_left }} Seats</h5>
                        </div>
                        <div class="flex flex-row items-center gap-x-1 justify-end">
                            <a href="" class="px-2 py-1 rounded-md bg-orange-50 text-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>                                                                                     
                            </a>                                                          
                            <button class="px-2 py-1 rounded-md bg-red-50 text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg> 
                            </button>
                        </div>
                    </div>
                @endforeach          
            </div>
        </div>
    </div>
</x-app-layout>