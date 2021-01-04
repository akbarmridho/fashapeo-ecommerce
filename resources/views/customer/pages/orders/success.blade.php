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
                <i class="fas fa-check fa-4x text-success my-3"></i>
                <p class="fw-bold">Your payment has been confirmed. <br> We will proccess your order immediately</p>
            </div>
        </div>
    </div>
</main>
@endsection