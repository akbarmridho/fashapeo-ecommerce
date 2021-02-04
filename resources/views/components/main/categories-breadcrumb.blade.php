@foreach ($categories as $parentCategory)
    @if ($parentCategory->id == $category)
        <li class="breadcrumb-item"><a class="text-body"
                href="{{ route('products.category', ['category' => $parentCategory]) }}">{{ $parentCategory->name }}</a>
        </li>
    @else
        @foreach ($parentCategory->children as $children)
            @if ($children->id == $category)
                <li class="breadcrumb-item"><a class="text-body"
                        href="{{ route('products.category', ['category' => $parentCategory]) }}">{{ $parentCategory->name }}</a>
                </li>
                <li class="breadcrumb-item"><a class="text-body"
                        href="{{ route('products.category', ['category' => $children]) }}">{{ $children->name }}</a>
                </li>
            @endif
        @endforeach
    @endif
@endforeach
