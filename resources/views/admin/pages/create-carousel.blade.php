@extends('layouts.admin')

@section('title')
    Create Carousel
@endsection

@section('additional-script')
    <script src="{{ mix('/js/pages/admin/createCarousel.js') }}" defer></script>
@endsection

@section('content')
    <div class="mb-3">
        <h3>Create Carousel</h3>
    </div>
    <form action="{{ route('admin.carousel.create') }}" method="post">
        @csrf
        <div class="row mb-3">
            <h4>Carousel Image</h4>
            <p>Used image aspect ratio is 2:1.</p>
            <input type="file" name="image" id="image" class="filepond" required />
        </div>
        <div class="row mb-3">
            <h4>Carousel Caption</h4>
            <div class="form-outline mt-2">
                <input type="text" name="text" id="text" class="form-control" maxlength="50">
                <label for="text" class="form-label">Description</label>
            </div>
            <div class="form-text">You can include HTML element and classes</div>
            <div class="form-outline mt-2">
                <input type="text" name="text_class" id="text_class" class="form-control" maxlength="50"
                    value="display-3 fw-bold">
                <label for="text" class="form-label">Description Class</label>
            </div>
            <div class="form-text">Description element classes. Separate by space.</div>
            <div class="form-outline mt-2">
                <input type="url" name="link" id="link" class="form-control">
                <label for="link" class="form-label">CTA Link</label>
            </div>
            <div class="form-text">CTA Button. Leave blank to disable</div>
            <div class="form-outline mt-2">
                <input type="text" name="link_text" id="link_text" class="form-control" maxlength="30">
                <label for="link_text" class="form-label">CTA Link Text</label>
            </div>
            <div class="form-text">CTA Link Text. Leave blank to disable</div>
            <div class="form-outline mt-2">
                <input type="text" name="link_class" id="link_class" class="form-control" maxlength="50"
                    value="btn btn-outline-light btn-lg">
                <label for="link_class" class="form-label">CTA HTML Class</label>
            </div>
            <div class="form-text">CTA element classes. Separate by space.</div>
        </div>
        <div class="row">
            <button class="btn btn-primary float-end" type="submit">Submit</button>
        </div>
    </form>
@endsection
