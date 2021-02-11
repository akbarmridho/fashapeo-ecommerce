@extends('layouts.admin')

@section('title')
    Notifications
@endsection

@section('content')
    <div class="row mt-3">
        <h3 class="fw-bold">Notifications</h3>
        <div class="col-12">
            @if ($notifications->isEmpty())
                <div>
                    <h4>No Notification</h4>
                </div>
            @else
                @foreach ($notifications as $notification)
                    <x-main.notifications :notification="$notification" />
                @endforeach
            @endif
        </div>
    </div>
@endsection
