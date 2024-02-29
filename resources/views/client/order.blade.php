@extends('layouts.client')
@section('content')
<div class="flex flex-col bg-[#09150f] p-2 rounded-2xl space-y-2 border-l border-slate-700">
  <h5 class="text-xl font-semibold text-white p-2">Payments</h5>
    <div class="grid grid-cols-3 gap-6 bg-[#0d1818] p-4 rounded-2xl">
        <div class="flex flex-col border-b border-slate-800 justify-between space-y-2">
            <h5 class="text-lg font-medium text-white">Name</h5>
            <p class="text-gray-400 pb-1">{{ $data['name'] }}</p>
        </div>
        <div class="flex flex-col border-b border-slate-800 justify-between space-y-2">
            <h5 class="text-lg font-medium text-white">Country</h5>
            <p class="text-gray-400 pb-1">{{ $data['country'] }}</p>
        </div>
        <div class="flex flex-col border-b border-slate-800 justify-between space-y-2">
            <h5 class="text-lg font-medium text-white">Email</h5>
            <p class="text-gray-400 pb-1">{{ $data['email'] }}</p>
        </div>
        <div class="flex flex-col border-b border-slate-800 justify-between space-y-2">
            <h5 class="text-lg font-medium text-white">Phone</h5>
            <p class="text-gray-400 pb-1">{{ $data['phone'] }}</p>
        </div>
        <div class="flex flex-col border-b border-slate-800 justify-between space-y-2">
            <h5 class="text-lg font-medium text-white">How much person</h5>
            <p class="text-gray-400 pb-1">{{ $data['person'] }} persons</p>
        </div>
        <div class="flex flex-col border-b border-slate-800 justify-between space-y-2">
            <h5 class="text-lg font-medium text-white">Menu</h5>
            <p class="text-gray-400 pb-1">{{ $data['menu'] }}</p>
        </div>
        <div class="flex flex-col border-b border-slate-800 justify-between space-y-2">
            <h5 class="text-lg font-medium text-white">Party</h5>
            <p class="text-gray-400 pb-1">{{ $data['party'] }}</p>
        </div>
        <div class="flex flex-col border-b border-slate-800 justify-between space-y-2">
            <h5 class="text-lg font-medium text-white">request</h5>
            <p class="text-gray-400 pb-1">{{ $data['request'] }}</p>
        </div>
        <div class="flex flex-col border-b border-slate-800 justify-between space-y-2">
            <h5 class="text-lg font-medium text-white">birthday</h5>
            <p class="text-gray-400 pb-1">{{ $data['birthday'] }}</p>
        </div>
        <div class="flex flex-col border-b border-slate-800 justify-between space-y-2">
            <h5 class="text-lg font-medium text-white">Date and Time</h5>
            <p class="text-gray-400 pb-1">{{ $data['book_time'] }}</p>
          </div>
        <div class="flex flex-col border-b border-slate-800 justify-between space-y-2">
            <h5 class="text-lg font-medium text-white">Payment Method</h5>
            <p class="text-gray-400 pb-1">{{ $data['payment'] }}</p>
        </div>
        <div class="flex flex-col border-b border-slate-800 justify-between space-y-2">
            <h5 class="text-lg font-medium text-white">Total</h5>
            <p class="text-gray-400 pb-1">{{ $data['amount'] }}</p>
        </div>
    </div>
    <button class="w-full py-2 rounded-lg text-white bg-[#14262b] font-medium" id="pay-button">Pay Now</button>
</div>
<script>
  // Midtrans
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      window.snap.pay('{{$snapToken}}', {
        onSuccess: function(result){
          window.location.href='/success'
        },
        onPending: function(result){
          alert("wating your payment!");
        },
        onError: function(result){
          alert("payment failed!");
          window.location.href='/'
        },
        onClose: function(){
          window.location.href='/'
        }
      })
    });
</script>
@endsection