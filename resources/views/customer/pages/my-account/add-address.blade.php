@extends('layouts.main')

@section('title')
Add address
@endsection

@section('additional-script')
<script src="{{ mix('/js/pages/customer/createAddress.js') }}" defer></script>
@endsection

@section('content')
<main>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 col-md-3 me-4">
            @include('customer.includes.my-account-nav');
            </div>
            <div class="col-12 col-md-8 p-4 shadow-1">
                <p class="h5">Add Address</p>
                <div class="mt-4">
                    <x-customer.address-form />
                </div>
            </div>
        </div>
    </div>
</main>
@endsection