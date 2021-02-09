@extends('layouts.main')

@section('title')
    Order Detail
@endsection

@section('content')
    <main>
        <div class="container">
            <div class="row mt-5">
                <div class="col-12 col-md-3 me-4">
                    @include('customer.includes.my-account-nav');
                </div>
                <div class="col-12 col-md-8 p-4 shadow-1">
                    <x-customer.order-details :order="$order" />
                </div>
            </div>
        </div>
        @include('main.modals.confirm-action-modal')
    </main>
@endsection
