@extends('layouts.client')
@section('content')
<div class="flex flex-col w-6/12 mx-auto p-4 rounded-lg bg-white border drop-shadow-md">
    <h5 class="text-xl font-bold text-center border-b pb-4">Order no {{ $no_invoice }}</h5>
    <div class="grid grid-cols-1 space-y-2 my-4">
        <div class="flex flex-col">
            <h5 class="text-sm font-medium text-gray-600">Name</h5>
            <p class="text-lg font-semibold">{{ $data['name'] }}</p>
        </div>
        <div class="flex flex-col">
            <h5 class="text-sm font-medium text-gray-600">How much person</h5>
            <p class="text-lg font-semibold">{{ $data['person'] }} persons</p>
        </div>
        <div class="flex flex-col">
            <h5 class="text-sm font-medium text-gray-600">Menu</h5>
            <p class="text-lg font-semibold">{{ $data['menu'] }}</p>
        </div>
        <div class="flex flex-col">
            <h5 class="text-sm font-medium text-gray-600">Date and Time</h5>
            <p class="text-lg font-semibold">{{ $data['book_date'] }} - {{ $data['book_time'] }}</p>
        </div>
        <div class="flex flex-col">
            <h5 class="text-sm font-medium text-gray-600">Payment Method</h5>
            <p class="text-lg font-semibold">{{ $data['payment'] }}</p>
        </div>
        <div class="flex flex-col">
            <h5 class="text-sm font-medium text-gray-600">Total</h5>
            <p class="text-lg font-semibold">{{ $data['amount'] }}</p>
        </div>
    </div>
    <button class="py-2 bg-black text-white rounded-lg" id="pay-button">Pay Now</button>
</div>

<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      window.snap.pay('{{$snapToken}}', {
        onSuccess: function(result){
          window.location.href='/'
        },
        onPending: function(result){
          alert("wating your payment!"); console.log(result);
        },
        onError: function(result){
          alert("payment failed!"); console.log(result);
          window.location.href='/'
        },
        onClose: function(){
          window.location.href='/'
        }
      })
    });
</script>
@endsection