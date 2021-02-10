@extends('layouts.main')

@section('title')
    Shipment Option
@endsection

@section('additional-script')
    <script src="{{ mix('/js/pages/customer/shipment.js') }}" defer></script>
@endsection

@section('content')
    <main>
        <div class="container">
            <div class="col-12 col-md-10 col-lg-8 mt-5 p-5 mx-auto bg-light">
                <x-customer.order-progress />
                <x-customer.shipment-options :order="$order" :shipments="$shipments" />
            </div>
        </div>
    </main>
@endsection
