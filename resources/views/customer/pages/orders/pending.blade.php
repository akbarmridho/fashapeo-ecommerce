@extends('customer.layouts.main')

@section('title')
Payment Options
@endsection

@section('content')
<main>
    <div class="container">
        <div class="col-12 col-md-10 col-lg-8 mt-5 p-5 mx-auto bg-light">
            <x-customer.order-progress /> 
            <div class="row my-5 text-center">
                <i class="fas fa-pause fa-4x text-info my-3"></i>
                <p class="fw-bold">Your payment request has been made<br> Please pay the invoice before expiration date <br> Click button below to review payment instructions</p>
                <button class="btn btn-primary">View Instructions</button>
            </div>
        </div>
    </div>
</main>
@endsection