@extends('layouts.app')

@section('child-script')
    <script src="{{ mix('/js/pages/main.js') }}" defer></script>
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
