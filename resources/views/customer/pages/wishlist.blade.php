@extends('layouts.main')

@section('title')
    Wishlist
@endsection

@section('additional-script')
    <script src="{{ mix('/js/pages/customer/wishlist.js') }}" defer></script>
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
                            Wishlist
                        </li>
                    </ol>
                </div>
                <hr class="divider">
            </div>
            <div class="row">
                <h4>Your wishlist</h4>
                <div class="col-12 col-md-7 p-4 mr-auto">
                    @foreach ($wishlists as $wishlist)
                        <x-main.product-wishlist :product="$wishlist" />
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection

@section('additional-layout')
    @include('main.notifications.wishlists')
@endsection
