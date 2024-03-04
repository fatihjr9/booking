@extends('layouts.client')
@section('content')
<div class="flex flex-col bg-[#09150f] p-2 rounded-2xl space-y-2 border-l border-slate-700">
  <h5 class="text-xl font-semibold text-white p-2">Payments</h5>
    <div class="grid grid-cols-3 gap-6 bg-[#0d1818] p-4 rounded-2xl">
        <div class="flex flex-col border-b border-slate-800 justify-between space-y-2">
            <h5 class="text-lg font-medium text-white">Name</h5>
            <p class="text-gray-400 pb-1">{{ $res['merchantName'] }}</p>
        </div>
    <button class="w-full py-2 rounded-lg text-white bg-[#14262b] font-medium">Pay Now</button>
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