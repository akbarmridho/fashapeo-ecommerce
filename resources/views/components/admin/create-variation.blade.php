<form action="{{ route('admin.variants.store') }}" method="POST" class="my-3">
    @csrf
    <div class="form-outline mb-3">
        <input 
            name="name"
            type="text"
            id="name"
            class="form-control @error('name') is-invalid @enderror"
            required/>
        <label class="form-label" for="name">Name</label>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>