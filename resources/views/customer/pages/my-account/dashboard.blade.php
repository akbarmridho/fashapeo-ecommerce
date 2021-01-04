@extends('customer.layouts.main')

@section('title')
My Account
@endsection

@section('content')
<main>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 col-md-3 me-4">
            @include('customer.includes/my-account-nav');
            </div>
            <div class="col-12 col-md-8 p-4 shadow-1">
                <p>Hello, this is your dashboard</p>
            </div>
        </div>
    </div>
</main>
@endsection