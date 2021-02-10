@extends('layouts.admin')

@section('title')
    Completed Orders
@endsection

@section('content')

    <div class="row mx-3">
        <h3 class="fw-bold">Completed Orders</h3>
        <x-admin.session-alert />

        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.orders.active') }}">Active Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.orders.completed') }}">Completed Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.orders.cancelled') }}">Cancelled Orders</a>
            </li>
        </ul>

        <div class="col-12 mt-3">
            <x-admin.orders-table :orders="$orders" />
            <div class="justify-content-end">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

@endsection
