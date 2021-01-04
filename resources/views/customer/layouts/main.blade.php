@extends('customer.layouts.app')

@section('child-layout')

<!--Main Navigation-->
@include('customer.includes.header')
<!--Main Navigation-->

<!--Main layout-->
@yield('content')
<!--Main layout-->

<!-- Footer -->
@include('customer.includes.footer')
<!-- Footer -->

@endsection