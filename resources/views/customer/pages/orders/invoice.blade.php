@extends('customer.layouts.main')

@section('title')
Payment Options
@endsection

@section('content')
<main>
    <div class="container">
        <div class="col-12 col-md-10 col-lg-8 mt-5 p-5 mx-auto bg-light">
            <x-customer.order-progress /> 
            <x-customer.invoice /> 
        </div>
    </div>
</main>
@endsection