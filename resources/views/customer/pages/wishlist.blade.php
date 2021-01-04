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
                        Wishlist
                    </li>
                </ol>
            </div>
            <hr class="divider">
        </div>
        <div class="row">
            <h4>Your wishlist</h4>
            <div class="col-12 col-md-7 p-4 mr-auto"> 
                <x-customer.product-wishlist /> 
                <x-customer.product-wishlist /> 
                <x-customer.product-wishlist />
            </div>
        </div>
        
    </div>
</main>
@endsection