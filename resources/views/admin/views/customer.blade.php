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
                                    Packages
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
                                    Birthday
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Request
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    party
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
                                    {{ $item->packages }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="https://wa.me/{{ str_replace([' ', '-'], '', $item->phone) }}" target="_blank">{{ str_replace([' ', '-'], '', $item->phone) }}</a>
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
                                    <button data-modal-target="default-modal-{{ $item->id }}" data-modal-toggle="default-modal-{{ $item->id }}" class="px-3 py-1 rounded-md bg-slate-300 text-slate-800" type="button">
                                        See menu
                                    </button>
                                    <div id="default-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                    <h3 class="text-xl font-semibold text-gray-900">
                                                        Menu List
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal-{{ $item->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 space-y-4">
                                                    {{ $item->menu }}                                             
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                                                    <button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">I accept</button>
                                                    <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Decline</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap flex flex-col">
                                    {{ $item->book_time }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->birthday }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->request }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->party }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->amount }}                                
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->affiliate }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap flex items-center gap-x-1">
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
                <div class="p-4">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>