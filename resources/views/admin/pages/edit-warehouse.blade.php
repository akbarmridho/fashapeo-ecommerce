@extends('layouts.admin')

@section('title')
Create Warehouse
@endsection

@section('additional-script')
<script src="{{ mix('/js/pages/customer/createAddress.js') }}" defer></script>
@endsection

@section('content')

<div class="row">
    <div class="col-12 p-4">
        <h3 class="fw-bold">Update Warehouse</h3>
    </div>
    <div class="col-12 p-4 shadow-1">
        <x-admin.edit-warehouse-form :warehouse="$warehouse" />
    </div>
</div>

@endsection