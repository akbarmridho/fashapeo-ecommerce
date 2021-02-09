@extends('layouts.main')

@section('title')
    Edit Account
@endsection

@section('content')
    <main>
        <div class="container">
            <div class="row mt-5">
                <div class="col-12 col-md-3 me-4">
                    @include('customer.includes.my-account-nav');
                </div>
                <div class="col-12 col-md-8 p-4 shadow-1">
                    <div class="col-12">
                        <x-admin.session-alert />
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                        <x-auth.edit-account-form :user="$user" />
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
