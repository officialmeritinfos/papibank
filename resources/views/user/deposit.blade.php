@extends('user.base')
@section('content')
    @inject('injected','App\Defaults\Custom')
    @push('css')
        <style>
            .payment-option {
                display: flex;
                align-items: center;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                margin-bottom: 10px;
                cursor: pointer;
            }
            .payment-option img {
                width: 50px;
                margin-right: 10px;
            }
            .payment-details { display: none; }
        </style>
    @endpush
    <div class="container py-5  pd-top-40 mg-top-50">
       <div class="card">
           <div class="card-body">
               @include('templates.notification')
               <h2 class="mb-4">Choose Payment Method</h2>
               <form id="payment-form" method="post" enctype="multipart/form-data" action="{{route('deposit.new')}}">
                   @csrf
                   <div class="mb-3">
                       <label class="form-label">Amount to Deposit</label>
                       <input type="number" name="amount" class="form-control" step="0.01" placeholder="Enter Amount"  required>
                       <span class="form-text">Minimum: {{ $user->account_currency }} {{$web->minDeposit}}</span>
                   </div>
                   <div class="mb-3">

                       <div class="payment-option" onclick="showPaymentDetails('crypto-section')">
                           <img src="https://upload.wikimedia.org/wikipedia/commons/8/8b/Cryptocurrency_Logo.svg" alt="Crypto">
                           <strong>Cryptocurrency</strong>
                       </div>
                       <div class="payment-option" onclick="showPaymentDetails('giftcard-section')">
                           <img src="https://cdn.redmondpie.com/wp-content/uploads/2011/07/Apple-Logo.png" alt="Gift Card">
                           <strong>Gift Card</strong>
                       </div>
                       <div class="payment-option" onclick="showPaymentDetails('bank-section')">
                           <img src="https://upload.wikimedia.org/wikipedia/commons/3/31/PayPal_Logo2014.svg" alt="Bank Transfer">
                           <strong>Bank Transfer</strong>
                       </div>
                   </div>

                   <div id="crypto-section" class="payment-details">
                       <h3>Cryptocurrency Payment</h3>
                       <select name="crypto_method" class="form-control">
                           <option value="">Choose...</option>
                           @foreach($crypto_methods as $crypto)
                               <option value="{{$crypto->name}}">{{$crypto->name}}</option>
                           @endforeach
                       </select>
                   </div>

                   <div id="giftcard-section" class="payment-details">
                       <h3>Gift Card Payment</h3>
                       <select name="giftcard_type" class="form-control">
                           <option value="">Select Giftcard</option>
                           @foreach($gift_card_methods as $gift_card)
                               <option value="{{$gift_card->merchant}}">{{$gift_card->merchant}}</option>
                           @endforeach
                       </select>
                   </div>

                   <div id="bank-section" class="payment-details">
                       <h3>Bank Transfer Details</h3>
                       <select name="bank_transfer" class="form-control">
                           <option value="">Select Bank Transfer Method</option>
                           @foreach($bank_methods as $bank)
                               <option value="{{$bank->name}}">{{$bank->name}}</option>
                           @endforeach
                       </select>
                   </div>
                   <div class="text-center">
                       <button type="submit" class="btn btn-primary mt-3">Continue</button>
                   </div>
               </form>
           </div>
       </div>
    </div>

    @push('js')
        <script>
            function showPaymentDetails(id) {
                document.querySelectorAll('.payment-details').forEach(el => el.style.display = 'none');
                document.getElementById(id).style.display = 'block';
            }
        </script>
    @endpush

@endsection
