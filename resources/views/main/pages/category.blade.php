@extends('layouts.main')
@section('title')
    Product by category {{ $category->name }}
@endsection
@section('content')
    <main>
        @include('main.includes.category-header')
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-3 rounded-3 p-4">
                    @include('main.includes.product-filters')
                </div>
                <div class="col-lg-9 p-4">
                    <div class="d-flex">
                        <p class="small ">Displaying {{ $products->count() }} products for category
                            {{ $category->name }}
                            @if (request()->has('term'))
                                and search term {{ request()->term }}
                            @elseif(request()->has('min') || request()->has('max'))
                                and price range from {{ request()->min ?: 0 }} to {{ request()->max ?: 'undefined' }}
                            @endif
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
                        @if ($products->isEmpty())
                            <h3>No Product Found!</h3>
                        @else
                            @foreach ($products as $product)
                                <x-main.product-card :product="$product" />
                            @endforeach
                        @endif
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
