@extends('layouts.client')
@section('content')
<div class="flex flex-col space-y-4 justify-center mt-16">
    <div class="flex flex-col space-y-4 w-80 mx-auto">
        <div class="flex flex-col space-y-1 text-center">
            <h5 class="text-2xl font-bold text-white">Order Payment</h5>
            <p class="text-slate-400">Click button below to continue payment</p>
        </div>
        <a href="{{ $generatedUrl }}" class="w-full py-2 text-center rounded-lg text-white bg-[#14262b] text-sm font-medium">Pay Now</a>
    </div>
</div>
@endsection