@foreach ($categories as $parent)
    <a class="list-group-item list-group-item-action fw-bold"
        href="{{ route('products.category', ['category' => $parent]) }}">{{ $parent->name }}</a>
    @foreach ($parent->children as $child)
        <a class="list-group-item list-group-item-action"
            href="{{ route('products.category', ['category' => $child]) }}">{{ $child->name }}</a>
    @endforeach
@endforeach
