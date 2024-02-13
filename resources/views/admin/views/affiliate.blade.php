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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                    <h5 class="text-base font-medium text-slate-500">Total Pengeluaran bulan ini</h5>
                    <h5 class="text-xl font-bold">Rp 5.000.000</h5>
                </div>
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                    <h5 class="text-base font-medium text-slate-500">Karyawan yang mendapatkan</h5>
                    <h5 class="text-xl font-bold">Yanto</h5>
                </div>
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                    <h5 class="text-base font-medium text-slate-500">Tujuan Bank</h5>
                    <h5 class="text-xl font-bold">Yanto</h5>
                </div>
            </div>
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
                                    {{ $item->url }}
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
                                    {{ $item->clicked_count }}
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    <button>edt</button>
                                    <button>del</button>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>