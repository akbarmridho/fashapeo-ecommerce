<div class="card mb-3 shadow-0 border small">
    <div class="card-header"><b>{{ $notification->data['title'] }}</b> <span
            class="small">{{ $notification->created_at }}</span></div>
    <div class="card-body">
        <p class="card-text">
            {{ $notification->data['message'] }}
        </p>
        @if (isset($notification->data['action']))
            <a href="{{ $notification->data['link'] }}"
                class="btn btn-primary btn-sm">{{ $notification->data['action'] }}</a>
        @endif
    </div>
</div>
