@extends('layouts.auth')

@section('title')
Verify Email
@endsection

@section('content') 
<p class="text-center h2 fw-bold">Email Verification Needed</p>
@if (session('resent'))
    <div class="alert alert-success" role="alert">
        <p>A fresh verification link has been sent to your email address.</p>
    </div>
@endif
<div class="p-3">
    <p>Before proceeding, please check your email for a verification link.</p>
    <p>If you did not receive the email, click button below to request another link.</p>
</div>
<x-auth.verify-email />
@endsection