@extends('layouts.admin')

@section('title')
    Notifications
@endsection

@section('additional-script')
    <script src="{{ mix('/js/pages/notification.js') }}" defer></script>
@endsection

@section('content')
    <div class="row mt-3">
        <div class="d-flex justify-content-between">
            <p class="h3 fw-bold">Notifications</p>
            <form action="{{ route('notification.all') }}" method="post">
                @csrf
                <button class="btn shadow-0 link-dark outline-0" type="submit">Mark All as Read</button>
            </form>
        </div>
        <div class="col-12">
            @if ($notifications->isEmpty())
                <div>
                    <h4>No Notification</h4>
                </div>
            @else
                @foreach ($notifications as $notification)
                    <x-main.notifications :notification="$notification" />
                @endforeach
                <div class="float-end">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
