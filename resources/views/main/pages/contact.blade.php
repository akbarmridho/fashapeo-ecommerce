@extends('customer.layouts.main')

@section('title')
Fashapeo - Your Everyday Wear
@endsection

@section('content')
<main> 
    <div class="container p-5">
        @include('customer.includes.contact-form-card')
    </div>
</main>
@endsection