@extends('layouts.admin')

@section('title')
    Site Setting
@endsection

@section('content')

    <div class="row mt-3">
        <h3>Site Settings</h3>
    </div>

    {{-- favicon, name, tagline --}}

    <div class="row mt-3">
        <h5>Contact</h5>
        <div class="col-12 col-md-6">
            <form action="{{ route('admin.setting.contact') }}" method="post">
                @csrf
                <div class="form-outline mb-4">
                    <input id="whatsapp" name="whatsapp" type="text"
                        class="form-control @error('whatsapp', 'contact') is-invalid @enderror" placeholder="Whatsapp"
                        value="{{ setting('contact.whatsapp') }}">
                    <label for="whatsapp" class="form-label">Whatsapp</label>
                    @error('whatsapp', 'contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-outline mb-4">
                    <input name="email" type="email" class="form-control @error('email', 'contact') is-invalid @enderror"
                        placeholder="Email" value="{{ setting('contact.email') }}">
                    <label for="email" class="form-label">Email</label>
                    @error('email', 'contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-outline mb-4">
                    <input name="twitter" type="text" class="form-control @error('twitter', 'contact') is-invalid @enderror"
                        placeholder="Twitter" value="{{ setting('contact.twitter') }}">
                    <label for="twitter" class="form-label">Twitter</label>
                    @error('twitter', 'contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-outline mb-4">
                    <input name="facebook" type="text"
                        class="form-control @error('facebook', 'contact') is-invalid @enderror" placeholder="Facebook"
                        value="{{ setting('contact.facebook') }}">
                    <label for="facebook" class="form-label">Facebook</label>
                    @error('facebook', 'contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <h5>Mail</h5>
        <div class="col-12 col-md-6">
            <form action="{{ route('admin.setting.mail') }}" method="POST">
                @csrf
                <div class="form-outline mb-4">
                    <input name="email" type="email" class="form-control @error('email', 'mail') is-invalid @enderror"
                        placeholder="Sender Email" value="{{ setting('mailfrom.address') }}">
                    <label for="email" class="form-label">Sender Email</label>
                    @error('email', 'mail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-outline mb-4">
                    <input name="name" type="text" class="form-control @error('name', 'mail') is-invalid @enderror"
                        placeholder="Sender Name" value="{{ setting('mailfrom.name') }}">
                    <label for="name" class="form-label">Sender Name</label>
                    @error('name', 'mail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>

@endsection
