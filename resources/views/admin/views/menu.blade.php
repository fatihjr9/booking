<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Menu') }}
            </h2>
            <a href="{{ route('admin-menu-create') }}">Add Menu</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($data as $item)
                    <div class="p-4 rounded-lg shadow-sm border bg-white">
                        <div class="flex flex-col space-y-0.5 mb-3">
                            <h5 class="text-xl font-semibold">{{ $item->name }}</h5>
                            <p class="text-slate-400">{{ $item->description }}</p>
                        </div>
                        <p class="font-medium">{{ $item->price }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>