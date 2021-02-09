@extends('layouts.main')

@section('title')
Addresss
@endsection

@section('content')
<main>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 col-md-3 me-4">
            @include('customer.includes.my-account-nav');
            </div>
            <div class="col-12 col-md-8 p-4 shadow-1">
                <div class="d-flex justify-content-between align-items-center px-2">
                    <p class="h5">Addresses</p>
                    <a href="{{ route('customer.address.create') }}" class="btn btn-primary btn-floating"><i class="fas fa-plus"></i></a>
                </div>
                <div class="my-2">
                    <x-admin.session-alert />
                </div>
                <x-customer.address-table :addresses="$addresses" />
            </div>
            @include('main.modals.confirm-action-modal')
        </div>
    </div>
</main>
@endsection