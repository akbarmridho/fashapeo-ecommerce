@extends('layouts.main')

@section('title')
    Fashapeo - Your Everyday Wear
@endsection

@section('content')
    <main>
        @include('main.includes.main-carousel')
        <div class="container">
            <x-main.product-card-group title="NEW ARRIVAL" :products="$bestSeller" />
            <x-main.product-card-group title="NEW ARRIVAL" :products="$newArrival" />
            @include('main.samples.products-by-category')
        </div>
    </main>
@endsection
