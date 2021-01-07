@extends('layouts.app')

@section('child-sheet')
<link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
@endsection

@section('child-script')
<script src="{{ asset('/js/index.js') }}" defer></script>
@endsection


@section('child-layout')

<!--Main Navigation-->
@include('main.includes.header')
<!--Main Navigation-->

<!--Main layout-->
@yield('content')
<!--Main layout-->

<!-- Footer -->
@include('main.includes.footer')
<!-- Footer -->

@endsection