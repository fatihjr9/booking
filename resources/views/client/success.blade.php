@extends('layouts.client')
@section('content')
<div class="w-fit mx-auto my-10 text-center">
    <img src="{{ asset('success.gif') }}" alt="" class="mx-auto">
    <div class="flex flex-col mt-2 mb-4">
        <h5 class="text-xl font-semibold text-white">Payment Successful</h5>
        <p class="text-gray-600">Please keep checking your email or whatsapp to get our notification</p>
    </div>
    <a href="{{ route('client-create') }}" class="px-4 py-2 w-fit bg-black text-white rounded-lg">Back to Home</a>
</div>
@endsection