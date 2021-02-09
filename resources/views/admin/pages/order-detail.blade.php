@extends('layouts.admin')

@section('title')
    Order Detail
@endsection

@section('content')

    <div class="row mx-3">
        <h3 class="fw-bold">Order Detail</h3>
        <div class="my-2">
            <x-admin.order-details :order="$order" />
        </div>
    </div>

@endsection
