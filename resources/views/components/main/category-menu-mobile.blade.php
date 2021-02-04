@foreach ($categories as $parent)
    <a class="list-group-item list-group-item-action fw-bold" href="#">{{ $parent->name }}</a>
    @foreach ($parent->children as $child)
        <a class="list-group-item list-group-item-action" href="#">{{ $child->name }}</a>
    @endforeach
@endforeach
