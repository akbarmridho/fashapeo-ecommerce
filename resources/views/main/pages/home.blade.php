@extends('layouts.main')

@section('title')
    Fashapeo - Your Everyday Wear
@endsection

@section('content')
    <main>
        @include('main.includes.main-carousel')
        <div class="container">
            <x-main.product-card-group title="BEST SELLER" :products="$bestSeller" tag="best" />
            <x-main.product-card-group title="NEW ARRIVAL" :products="$newArrival" tag="new" />
            @include('main.samples.products-by-category')
        </div>
    </main>
@endsection
