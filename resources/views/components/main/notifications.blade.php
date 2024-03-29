<div class="card mb-3 shadow-0 border small notification
@if ($notification->unread()) bg-notification @endif
    " data-id="{{ $notification->id }}">
    <div class="card-header"><b>{{ $notification->data['title'] }}</b><span
            class="small ps-2">{{ $notification->created_at }}</span></div>
    <div class="card-body">
        <p class="card-text">
            {{ $notification->data['message'] }}
        </p>
        @if (array_key_exists('link', $notification->data))
            <a href="{{ $notification->data['link'] }}" class="btn btn-primary btn-sm">Open Link</a>
        @endif
    </div>
</div>
