@extends('layouts.main')

@section('title')
    Proceed Payment
@endsection

@section('additional-script')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('vendor.midtrans_client') }}" defer></script>
    <script type="text/javascript" defer>
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            snap.pay("{{ $token }}");
        });

    </script>
@endsection

@section('content')
    <main>
        <div class="container">
            <div class="col-12 col-md-10 col-lg-8 mt-5 p-5 mx-auto bg-light">
                <x-customer.order-progress />
                <x-customer.invoice :order="$order" />
            </div>
        </div>
    </main>
@endsection
