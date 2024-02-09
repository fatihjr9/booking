<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Affiliate') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-white">
                        <tr>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Affiliate Name
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Generated URL
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Clicked Count
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Contact
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                No Rek
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Action
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>