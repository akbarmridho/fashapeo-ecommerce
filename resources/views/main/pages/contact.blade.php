@extends('layouts.main')

@section('title')
    Contact Us
@endsection

@section('content')
    <main>
        <div class="container p-5">
            @include('main.includes.contact-form-card')
        </div>
    </main>
@endsection
