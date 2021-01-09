@extends('layouts.app')

@section('child-sheet')
<link rel="stylesheet" href="{{ mix('css/admin.css') }}">
@endsection

@section('child-script')
<script src="{{ mix('js/admin.js') }}" defer></script>
@endsection

@section('child-layout')

<div id="wrapper">

    @include('admin.includes.sidebar')

    <div id="content">

        @include('admin.includes.navbar')

        <div class="container-fluid p-5">
            @yield('content')
        </div>

    </div>
</div>

@endsection 