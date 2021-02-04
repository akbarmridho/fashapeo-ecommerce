@extends('layouts.main')
@section('title')
Fashapeo - Your Everyday Wear
@endsection 

@section('content')
<main>
    <div class="container mt-5">
        <div class="row  rounded-3 p-4">
            <div class="col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-body" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-body" href="#">Shirts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Mango Man Basic T Shirt
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
            <div class="col-3">
              <img
                src="/img/kaos1.jpg"
                alt=""
                class="img-fluid hover-shadow rounded-3"
                data-index="0"
              />
            </div>
            <div class="col-3">
              <img
                src="/img/celana1.jpg"
                alt=""
                class="img-fluid hover-shadow rounded-3"
                data-index="1"
              />
            </div>
            <div class="col-3">
              <img
                src="/img/celana2.jpg"
                alt=""
                class="img-fluid hover-shadow rounded-3"
                data-index="2"
              />
            </div>
            <div class="col-3">
              <img
                src="/img/jacket1.jpg"
                alt=""
                class="img-fluid hover-shadow rounded-3"
                data-index="3"
              />
            </div>
         
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-6 px-5 pt-3">
                <h2 class="h2">
                    {{ $product->name }}
                </h2>
               <p class="small"><span class="badge bg-danger">Best Seller</span><i class="fas fa-minus mx-1"></i> <b>Sold {{ $product->sold }} Product</b></p>

                <div class="row mt-5">
                    <form action="" id="variations">
                    <p class="h5">Color:</p>
                    <div class="col-12 mb-4 product-variant" data-variant="color">
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="color"
                                id="color1"
                                value="white"
                            />
                            <label class="form-check-label" for="color1"
                                >White</label
                            >
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="color"
                                id="color2"
                                value="blue"
                            />
                            <label class="form-check-label" for="color2"
                                >Blue</label
                            >
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="color"
                                id="color3"
                                value="red"
                            />
                            <label class="form-check-label" for="color3"
                                >Red</label
                            >
                        </div>
                    </div>
                    <p class="h5">Size:</p>
                    <div class="col-12 mb-4 product-variant" data-variant="size">
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="size"
                                id="size1"
                                value="s"
                            />
                            <label class="form-check-label" for="size1"
                                >S</label
                            >
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="size"
                                id="size2"
                                value="m"
                            />
                            <label class="form-check-label" for="size2"
                                >M</label
                            >
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="size"
                                id="size3"
                                value="l"
                            />
                            <label class="form-check-label" for="size3"
                                >L</label
                            >
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="size"
                                id="size4"
                                value="xl"
                            />
                            <label class="form-check-label" for="size4"
                                >XL</label
                            >
                        </div>
                    </div>
                    </form>
                    <div class="row mb-2"><h3>
                        <p class="h5">Price:</p>
                    <span class="text-danger fw-bold">
                        Rp<span id="price">350.000</span>
                    </span>
                    <span class="text-muted">
                        <small>
                            <s>Rp500.000</s>
                        </small>
                    </span>
                </h3></div>
                    <div class="row">
                        
                       <div class="col-4">
                            <p class="h5">Quantity:</p><div class="input-group input-group-sm mb-3">
                        <button
                            type="button"
                            class="btn btn-sm btn-outline-primary"
                            id="decrement"
                        >
                           <i class="fas fa-minus"></i>
                        </button>
                        <input
                            type="number"
                            id="quantity"
                            class="form-control text-center"
                            value="1"
                            min="1"
                            max="100"
                        />
                        <button
                            type="button"
                            class="btn btn-sm btn-outline-primary"
                            id="increment"
                        >
                            <i class="fas fa-plus"></i>
                        </button>
                       </div>
                    </div>
                </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12 col-md-8">
                        <button class="btn btn-secondary btn-rounded">
                            <i class="far fa-heart mr-3"></i> Add to wishlist
                        </button>
                        <button class="btn btn-primary btn-rounded mt-2">
                        <i class="fas fa-cart-plus mr-3" aria-hidden="true"></i>
                        Add to cart
                    </button>
                    </div>
                </div>
                <dl class="row">
                   <h5>Product Details:</h5>
                   <dt class="col-3">Weight</dt>
                   <dd class="col-9">100gr</dd>
                   <dt class="col-3">Status</dt>
                   <dd class="col-9">New, in stock</dd>
                   <dt class="col-3">Brand</dt>
                   <dd class="col-9">Mango Man</dd>
                   <dt class="col-3">Fabric</dt>
                   <dd class="col-9">Premium Cotton</dd>
                   <dt class="col-3">Cutting</dt>
                   <dd class="col-9">Slim Fit</dd>
               </dl>
                
            </div>
        </div> 
        <div class="row p-5 rounded-3">
            <hr class="divider">
            <div class="col-12">
                <p class="h4">Product Description:</p>
                {!! $product->description !!}
            </div>
        </div>
        {{-- <x-customer.recommendation title="Recent Viewed" /> --}}
        <x-main.recommendation title="For you" />
    </div>
    {{-- <link rel="stylesheet" href="{{ asset('css/glightbox.min.css') }}">
    <script src="{{ asset('js/glightbox.min.js') }}"></script>
    <script src="{{ asset('js/pages/product.js') }}" defer></script> --}}
</main>
@endsection
