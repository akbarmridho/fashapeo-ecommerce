@extends('customer.layouts.main')

@section('title')
Order Error
@endsection

@section('content')
<main>
    <div class="container">
        <div class="col-12 col-md-10 col-lg-8 mt-5 p-5 mx-auto bg-light">
            <x-customer.order-progress /> 
            <div class="row my-5 text-center">
                <i class="fas fa-times fa-4x text-danger my-3"></i>
                <p class="fw-bold">Oops, something went wrong! Error code: 403</p>
                <p>Please contact admin immediately</p>
            </div>
        </div>
    </div>
</main>
@endsection