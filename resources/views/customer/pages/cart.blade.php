@extends('customer.layouts.main')

@section('title')
Fashapeo - Your Everyday Wear
@endsection

@section('content')
<main>
    <div class="container">
        <div class="row my-5">
            <div class="col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-body" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-body" href="#">My Account</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Carts
                    </li>
                </ol>
            </div>
            <hr class="divider">
        </div>
        <div class="row">
            <h4>Your cart</h4>
            <div class="col-12 col-md-7 p-4">
                <x-customer.product-cart />
                <x-customer.product-cart /> 
                <x-customer.product-cart />
            </div>
            <div class="col-12 col-md-3 ms-auto">
                <div class="card">
                    <div class="card-header fw-bold bg-light">Order Summary</div>
                    <div class="card-body small">
                        <div class="d-flex justify-content-between">
                            <p class="card-text">Total items</p>
                            <p class="card-text">Rp1.500.000</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="card-text">Discount</p>
                            <p class="card-text">-Rp500.000</p>
                        </div>
                         <div class="d-flex justify-content-between fw-bold">
                            <p class="card-text">Total</p>
                            <p class="card-text">Rp1.000.000</p>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                    <button class="btn btn-primary"><i class="fas fa-shopping-cart me-3"></i>Checkout</button>   
                    </div>
                    </div>
            </div>
        </div>
        
    </div>
</main>
@endsection