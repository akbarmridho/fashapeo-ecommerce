<div class="row gy-4 mt-4">
    <div class="col-12">
        <h3 class="text-center">{{ $title }}</h3>
    </div>
    @isset($tag)
        @foreach ($products as $product)
            <x-main.product-card :product="$product" :tag="$tag" />
        @endforeach
    @else
        @foreach ($products as $product)
            <x-main.product-card :product="$product" />
        @endforeach
    @endisset
</div>
