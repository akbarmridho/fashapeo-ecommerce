<form action="{{ route('contact') }}" method="POST">
    @csrf
    <div class="row mb-4">
        <div class="col">
            <div class="form-outline">
                <input required name="name" type="text" id="form8Example1"
                    class="form-control @error('name') is-invalid @enderror" />
                <label class="form-label" for="form8Example1">Name</label>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="form-outline">
                <input required name="email" type="email" id="form8Example2"
                    class="form-control @error('email') is-invalid @enderror" />
                <label class="form-label" for="form8Example2">Email address</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="form-outline">
                <textarea required name="message" maxlength="1000"
                    class="form-control @error('message') is-invalid @enderror" id="textAreaExample"
                    rows="4"></textarea>
                <label class="form-label" for="textAreaExample">Message</label>
                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button class="btn btn-info btn-floating float-end me-2" style="top: -15%; width:60px; height: 60px"
                type="submit"><i class="far fa-paper-plane fa-3x"></i></button>
        </div>
    </div>
</form>
