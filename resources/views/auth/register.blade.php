@extends('layouts.auth')

@section('title')
Register
@endsection

@section('additional-script')
<script src="{{ mix('js/pages/auth/register.js') }}" defer></script>
@endsection

@section('content') 
<p class="text-center h2 fw-bold">Sign Up</p>
<x-auth.register />
@endsection