@extends('customer.layouts.main')
@section('title') Fashapeo - Your Everyday
    Wear
@endsection
@section('content')
    <main>
        <!-- Carousel wrapper -->
        @include('customer.includes.category-header')
        <!-- Carousel wrapper -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-3 rounded-3 p-4">
                    @include('customer.includes.product-filters')
                </div>
                <div class="col-lg-9 p-4">
                    <div class="d-flex justify-content-between">
                        <p class="small ">Displaying 16 products for category shirts</p>
                        <div class="">
                            <select class="form-select">
                                <option selected>Sort by</option>
                                <option value="1">Best</option>
                                <option value="2">Newest</option>
                                <option value="3">Price low to high</option>
                                <option value="">Price high to low</option>
                            </select>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="row g-4">
                        @include('customer.samples.products')
                        @include('customer.samples.products')
                    </div>
                    <x-customer.paginator />
                </div>
            </div>
        </div>
    </main>
@endsection
