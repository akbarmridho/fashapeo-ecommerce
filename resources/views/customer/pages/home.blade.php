@extends('customer.layouts.main')

@section('title')
Fashapeo - Your Everyday Wear
@endsection

@section('content')
<main>
    <!-- Carousel wrapper -->
    @include('customer.includes.main-carousel')
    <!-- Carousel wrapper -->
    <div class="container">
        <x-customer.product-card-group productsCardGroupTitle="BEST SELLER" />
        <x-customer.product-card-group productsCardGroupTitle="NEW ARRIVAL" />
        @include('customer.samples.products-by-category')
    </div>
</main>
@endsection