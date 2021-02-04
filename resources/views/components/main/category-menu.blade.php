<div class="d-flex small">
    @foreach ($categories as $parent)
        <div class="flex-fill px-3 my-3" style="min-width: 175px">
            <a href="" class="dropdown-item fw-bold">{{ $parent->name }}</a>
            <hr class="dropdown-divider" />
            @foreach ($parent->children as $child)
                <a href="" class="dropdown-item">{{ $child->name }}</a>
            @endforeach
        </div>
    @endforeach
</div>
