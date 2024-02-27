<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center gap-x-4">
            <p class="text-gray-400 leading-tight">{{ __('Dashboard') }}</p>
            <hr class="rotate-45">
            <p class="font-semibold text-gray-800 leading-tight">Add Menu</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-fit mx-auto">
                <form action="{{ route('admin-menu-store') }}" method="POST" enctype="multipart/form-data" class="p-4 flex flex-col w-96">
                    @csrf
                    <div class="flex flex-col space-y-2 mb-4">
                        <div class="flex flex-col space-y-1">
                            <p>Menu Name</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="name" id="">
                            @error('name')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Category</p>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" name="category" id="">
                                @foreach ($data as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Description</p>
                            <textarea class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="description" id=""></textarea>
                            @error('description')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p>Price</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="number" name="price" id="">
                            @error('price')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-black text-white py-2 rounded-lg">Add</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
