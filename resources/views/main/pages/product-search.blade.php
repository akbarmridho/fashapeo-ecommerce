@extends('layouts.main')
@section('title')
    Product Search
@endsection
@section('content')
    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-3 rounded-3 p-4">
                    @include('main.includes.product-filters')
                </div>
                <div class="col-lg-9 p-4">
                    <div class="d-flex">
                        <p class="small ">Displaying {{ $products->count() }} products for search query
                            {{ $query }}
                        </p>
                        {{-- <div class="">
                            <select class="form-select">
                                <option selected>Sort by</option>
                                <option value="1">Best</option>
                                <option value="2">Newest</option>
                                <option value="3">Price low to high</option>
                                <option value="">Price high to low</option>
                            </select>
                        </div> --}}
                    </div>
                    <hr class="divider">
                    <div class="row g-4">
                        @foreach ($products as $product)
                            <x-main.product-cart :product="$product" />
                        @endforeach
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
