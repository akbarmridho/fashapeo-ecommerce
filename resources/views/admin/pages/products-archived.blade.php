@extends('layouts.admin')

@section('title')
Products
@endsection

@section('content')

<div class="row mx-3">
    <h3 class="fw-bold">Products</h3>
    <x-admin.session-alert />

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.products') }}">Active Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.products.archived') }}">Archived Products</a>
        </li>
    </ul>

    <div class="col-12 mt-3">
        <x-admin.products-table :products="$products"/>
        <div class="justify-content-end">
            {{ $products->links() }}
        </div>
    </div>
</div>

@endsection
