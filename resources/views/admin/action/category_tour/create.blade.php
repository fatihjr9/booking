<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center gap-x-4">
            <p class="text-gray-400 leading-tight">{{ __('Dashboard') }}</p>
            <hr class="rotate-45">
            <p class="font-semibold text-gray-800 leading-tight">Add Category</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 rounded-lg w-8/12 mx-auto">
                <form action="{{ route('admin-category-tour-store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div class="flex flex-col space-y-1">
                            <p>Category Name</p>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" type="text" name="name" id="">
                        </div>
                    </div>
                    <button class="w-full py-2 rounded-lg bg-black text-white" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
