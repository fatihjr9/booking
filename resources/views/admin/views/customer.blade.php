<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">                
                <div class="relative overflow-x-scroll">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Customer Name
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Phone
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Country
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Person
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Menu
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Booking Time
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Payment Method
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Payment Amount
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Affiliate
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->phone }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->country }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->person }} persons
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->menu }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap flex flex-col">
                                    <p>{{ \Carbon\Carbon::parse($item->book_date)->format('l,d M Y') }}</p>
                                    <span>{{ $item->book_time }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->payment }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ Number::currency($item->amount, 'IDR') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->affiliate }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap flex items-center gap-x-1">
                                    <a href="mailto:{{ $item->email }}" class="p-0.5 bg-orange-50 text-orange-500 rounded-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                        </svg>                                          
                                    </a>
                                    <a href="https://wa.me/{{ str_replace(' ', '', $item->phone) }}" class="p-0.5 bg-green-50 text-green-500 rounded-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                                        </svg>                                          
                                    </a>
                                    <a href="" class="p-0.5 bg-yellow-50 text-yellow-500 rounded-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>                                          
                                    </a>
                                    <form action="{{ route('admin-customer-destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-0.5 bg-red-50 text-red-500 rounded-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>                                          
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>