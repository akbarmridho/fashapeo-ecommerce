<form class="text-center" method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit" class="btn btn-lg btn-primary">
        Resend Email
    </button>
</form>