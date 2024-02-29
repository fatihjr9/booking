<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employee Affiliate') }}
            </h2>
            <a href="{{ route('admin-affiliate-create') }}" class="px-4 py-2 bg-black rounded-lg text-white">Add Affiliate</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white overflow-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-white">
                        <tr>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Store Name
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Manager
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Whatsapp
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Package Selection
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                URL
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Bank Name
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Account Number
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Account Holder
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Clicked Count
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Fee per Click
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Total Fee
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    {{ $item->store_name }}
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    {{ $item->manager }}
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    {{ $item->email }}
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    {{ $item->whatsapp }}
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    {{ $item->category }}
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    <a href="{{ route('client-create', ['affiliate' => $item->url]) }}" target="_blank" class="text-blue-500 hover:underline">{{ $item->url }}</a>
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    {{ $item->bank_name }}
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    {{ $item->account_numb }}
                                </th>
                                
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    {{ $item->account_holder }}
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    <?php
                                        $affiliateCount = App\Models\customer::where('affiliate', $item->url)->count();
                                        echo $affiliateCount;
                                    ?>
                                </th>
                                
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    {{ $item->fees }}
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    {{ $item->fees * $affiliateCount }}
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap flex flex-row items-center gap-x-2">
                                    <a href="" class="p-0.5 bg-yellow-50 text-yellow-500 rounded-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>                                          
                                    </a>
                                    <form action="{{ route('admin-affiliate-destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-0.5 bg-red-50 text-red-500 rounded-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>                                          
                                        </button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>