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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 rounded-lg w-8/12 mx-auto">
                <form action="{{ route('admin-affiliate-store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div class="flex flex-col space-y-1">
                            <p>Store Name</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="store_name" id="">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Manager</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="manager" id="">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Email</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="email" name="email" id="">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Whatsapp</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="tel" name="whatsapp" id="">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Bank Name</p>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" name="bank_name" id="">
                                <x-list-bank/>
                            </select>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Account Number</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="account_numb" id="">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Account Holder</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="account_holder" id="">
                        </div>
                        <div class=" flex-col space-y-1 hidden">
                            <p>URL</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="url" id="">
                        </div>
                    </div>
                    <button class="w-full py-2 rounded-lg bg-black text-white" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
