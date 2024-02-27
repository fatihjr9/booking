<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center gap-x-4">
            <a href="{{ route('admin-affiliate') }}" class="text-gray-400 leading-tight">{{ __('Dashboard') }}</a>
            /
            <p class="font-semibold text-gray-800 leading-tight">Add Affiliate</p>
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
                            @error('store_name')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Manager</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="manager" id="">
                            @error('manager')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Email</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="email" name="email" id="">
                            @error('email')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Selected Category</p>
                            <select name="category" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg">
                                @foreach ($data as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Fee</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="tel" name="fees" id="">
                            @error('fees')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Whatsapp</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="tel" name="whatsapp" id="">
                            @error('whatsapp')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Bank Name</p>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" name="bank_name" id="">
                                <x-list-bank/>
                            </select>
                            @error('bank_name')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Account Number</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="account_numb" id="">
                            @error('account_numb')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Account Holder</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="account_holder" id="">
                            @error('account_holder')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror   
                        </div>
                        <div class=" flex-col space-y-1 hidden">
                            <p>URL</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="url" id="">
                            @error('url')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror   
                        </div>
                    </div>
                    <button class="w-full py-2 rounded-lg bg-black text-white" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
