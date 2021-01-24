@extends('layouts.app')

@section('child-sheet')
<link rel="stylesheet" href="{{ mix('/css/admin.css') }}">
@endsection

@section('child-script')
<script src="{{ mix('/js/admin.js') }}" defer></script>
@endsection

@section('child-layout')

<div class="container">
    @yield('content')
</div>

@endsection 