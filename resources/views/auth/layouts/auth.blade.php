@extends('layouts.app')

@section('child-sheet')
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('child-layout')

<div class="container">

<div class="row my-5">
    <div class="col mx-auto text-center">
        <img src="img/thin.png" alt="Logo" height="40">
    </div>
</div>

<div class="row my-5">
    <div class="col-6 d-none d-md-block p-5 my-auto">
        {{-- <img class="img-fluid" src="img/set1.jpg" alt=""> --}}
        <p class="fw-bold display-3">FASHAPEO</p>
        <p class="h4 text-muted">Explore our favourite collections</p>
        <p class="h4 text-muted">and become our members</p>
    </div>
    <div class="col-12 col-md-6">
        <div class="col-10 py-5 px-4 shadow-1-strong rounded rounded-5 mx-auto">
        @yield('content')
        </div>
    </div>
</div>

</div>

<footer>
    <div class="row mx-5 my-4">
        © 2020 Copyright: Fashapeo
    </div>
</footer>

@endsection