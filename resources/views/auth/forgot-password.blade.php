@extends('layouts.auth')

@section('title')
Forgot Password
@endsection

@section('content') 
<p class="text-center h2 fw-bold">Forgot Password</p>
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<x-auth.forgot-password />
@endsection