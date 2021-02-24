@extends('layouts.admin')

@section('title')
    Edit Account
@endsection

@section('additional-script')
    <script src="{{ mix('/js/pages/auth/register.js') }}" defer></script>
@endsection

@section('content')
    <div class="row mt-3">
        <h3 class="fw-bold">Update Account</h3>
        <div class="col-12">
            <x-admin.session-alert />
        </div>
        <div class="col-12 col-md-8 mt-4">
            <x-auth.edit-account-form :user="$user" />
        </div>
    </div>
@endsection
