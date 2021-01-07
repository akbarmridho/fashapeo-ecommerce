@extends('layouts.main')

@section('title')
Fashapeo - Your Everyday Wear
@endsection

@section('content')
<main>
    <!-- Carousel wrapper -->
    @include('main.includes.main-carousel')
    <!-- Carousel wrapper -->
    <div class="container">
        <x-main.product-card-group productsCardGroupTitle="BEST SELLER" />
        <x-main.product-card-group productsCardGroupTitle="NEW ARRIVAL" />
        @include('main.samples.products-by-category')
    </div>
</main>
@endsection