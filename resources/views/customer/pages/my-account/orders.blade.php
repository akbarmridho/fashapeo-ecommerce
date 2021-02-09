@extends('layouts.main')

@section('title')
    My Orders
@endsection

@section('content')
    <main>
        <div class="container">
            <div class="row mt-5">
                <div class="col-12 col-md-3 me-4">
                    @include('customer.includes.my-account-nav');
                </div>
                <div class="col-12 col-md-8 p-4 shadow-1">
                    <p class="h5">Your Orders</p>
                    <x-admin.session-alert />
                    <x-customer.orders-table :orders="$orders" />
                </div>
                <div class="col-12">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
