@extends('layouts.admin')

@section('title')
Warehouse
@endsection

@section('content')

<div class="row">
    <div class="col-12 p-4 shadow-1">
        <div class="d-flex justify-content-between align-items-center px-2">
            <h3 class="fw-bold">Warehouse</h3>
            <a href="{{ route('admin.warehouse.create') }}" class="btn btn-primary btn-floating"><i class="fas fa-plus"></i></a>
        </div>
        <div class="my-2">
            <x-admin.session-alert />
        </div>
        <x-admin.warehouses-table :warehouses="$warehouses" />
    </div>
</div>
@include('main.modals.confirm-action-modal')

@endsection