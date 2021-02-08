@extends('layouts.main')

@section('title')
    Carts
@endsection

@section('additional-script')
    <script src="{{ mix('js/pages/customer/cart.js') }}" defer></script>
@endsection

@section('content')
    <main>
        <div class="container">
            <div class="row my-5">
                <div class="col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-body" href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-body" href="{{ route('customer.dashboard') }}">My
                                Account</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Carts
                        </li>
                    </ol>
                </div>
                <hr class="divider">
            </div>
            <div class="row">

                @csrf
                <h4>Your cart</h4>
                <div class="col-12 col-md-7 p-4">
                    @foreach ($products as $product)
                        <x-main.product-cart :product="$product" />
                    @endforeach
                </div>
                <div class="col-12 col-md-3 ms-auto">
                    <x-main.cart-summary :summary="$summary" />
                </div>
            </div>
        </div>
    </main>
@endsection
