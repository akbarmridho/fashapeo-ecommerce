@extends('layouts.auth')

@section('title')
Admin Login
@endsection

@section('content') 
<p class="text-center h2 fw-bold">Sign In</p>
<x-auth.login />
@endsection