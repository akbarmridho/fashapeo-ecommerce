@extends('layouts.main')
@section('title')
    {{ $product->name }}
@endsection

@section('additional-script')
    <script src="{{ mix('/js/pages/product.js') }}" defer></script>
@endsection

@section('content')

    <div class="container mt-5">
        <div class="row  rounded-3 p-4">
            <div class="col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-body" href="{{ route('home') }}">Home</a></li>
                    <x-main.categories-breadcrumb :categories="$categories" :category="$product->category_id" />
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $product->name }}
                    </li>
                </ol>
            </div>
            <hr class="divider" />
            <div class="col-12 col-md-4 col-lg-6 px-5 py-4">

                <div class="hover-shadow">
                    <div id="productImage" class="rounded-3" data-index="0"></div>
                </div>
                <hr class="divider" />
                <div class="row g-1" id="productImageThumbnails">
                    @foreach ($product->images as $image)
                        <div class="col-3">
                            <img src="{{ $image->url }}" alt="" class="img-fluid hover-shadow rounded-3"
                                data-index="{{ $image->order }}" />
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-6 px-5 pt-3">
                <h2 class="h2">
                    {{ $product->name }}
                </h2>
                <p class="small"><span class="badge bg-danger">Best Seller</span><i class="fas fa-minus mx-1"></i>
                    <b>Sold {{ $product->sold }} Product</b>
                </p>
                <div id="variations">
                    <div class="row mt-5">
                        @isset($productInformation['variants'])
                            @foreach ($productInformation['variants'] as $variant => $options)
                                <p class="h5">{{ $variant }}:</p>
                                <div class="col-12 mb-4 product-variant" data-variant="{{ $variant }}">
                                    @foreach ($options as $option)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="{{ $variant }}"
                                                value="{{ $option }}" />
                                            <label class="form-check-label">{{ $option }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @endisset
                        <div class="row mb-2">
                            <p class="h5">Price:</p>
                            <div id="price">
                                <x-main.product-price-tag :price="$product->price" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p class="h5">Quantity:</p>
                                <div class="input-group input-group-sm mb-3">
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="decrement">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" id="quantity" class="form-control text-center" value="1" min="1"
                                        max="100" />
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="increment">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-4">
                        <div class="col-12 col-md-8">
                            @if ($wishlist)
                                <button class="btn btn-secondary btn-rounded" id="wishlist" data-state="selected"
                                    data-id="{{ $product->id }}">
                                    <i class="fas fa-heart mr-2"></i>
                                </button>
                            @else
                                <button class="btn btn-secondary btn-rounded" id="wishlist" data-state="unselected"
                                    data-id="{{ $product->id }}">
                                    <i class="far fa-heart mr-2"></i>
                                </button>
                            @endif
                            <button class="btn btn-primary btn-rounded mt-2" id="cart">
                                <i class="fas fa-cart-plus mr-3" aria-hidden="true"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                    <dl class="row">
                        <h5>Product Details:</h5>
                        <dt class="col-3">Weight</dt>
                        <dd class="col-9">{{ $product->weight . ' gr' }}</dd>
                        @isset($product->width)
                            <dt class="col-3">Width</dt>
                            <dd class="col-9">{{ $product->width . ' cm' }}</dd>
                        @endisset
                        @isset($product->height)
                            <dt class="col-3">Height</dt>
                            <dd class="col-9">{{ $product->height . ' cm' }}</dd>
                        @endisset
                        @isset($product->length)
                            <dt class="col-3">Length</dt>
                            <dd class="col-9">{{ $product->length . ' cm' }}</dd>
                        @endisset
                    </dl>
                </div>
            </div>
        </div>
        <div class="row p-5 rounded-3">
            <hr class="divider">
            <div class="col-12">
                <p class="h4">Product Description:</p>
                {!! $product->description !!}
            </div>
        </div>
        <x-main.product-card-group title="For you" :products="$recentViewed" />

    </div>
    <script>
        window.variantData = @json($productInformation, JSON_FORCE_OBJECT)

    </script>
@endsection

@section('additional-layout')
    @include('main.notifications.carts')
    @include('main.notifications.wishlists')
@endsection
