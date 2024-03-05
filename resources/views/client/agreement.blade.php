@extends('layouts.client')
@section('content')
    <div class="mx-auto p-4 rounded-xl bg-[#09150f] h-full">
        <x-agreement/>
        <div class="flex">
            <a href="{{ route('client-create') }}" class="mt-4 mx-auto w-full text-center py-2 rounded-lg text-slate-400 bg-[#0d1818] font-medium">Back to home</a>
        </div>
    </div>
@endsection