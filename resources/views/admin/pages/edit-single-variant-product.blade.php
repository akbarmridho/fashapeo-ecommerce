@extends('layouts.admin-plain')
@section('title')
Edit Product 
@endsection
@section('additional-script')
<script src="{{ mix('/js/pages/admin/createProduct.js') }}" defer></script>
@endsection @section('content')
<form action="" onkeypress="return event.keyCode != '13'">
    <div class="row mt-5 shadow-1-strong mb-4 p-4">
        <h3>Product Image</h3>
        <p>You can upload up to 5 images.</p>
        <input
            type="file"
            name="images[]"
            id="mainImage"
            class="filepond"
            required
        />
    </div>
    <div class="row my-4 shadow-1-strong p-4">
        <h3 class="mb-5">Product Info</h3>
        <h5>Product Title</h5>
        <div class="px-3 mb-5 w-75">
            <input
                name="name"
                type="text"
                id="form1"
                class="form-control"
                placeholder="Enter product title"
                value="{{ $product->name }}"
                required
            />
        </div>
        <h5>Product Category</h5>
        <div class="px-3 mb-5">
            <select
                name="category"
                class="select"
                id="category"
                height="50px"
                required
            >
                @foreach($categories as $parent)
                <optgroup label="{{ $parent->name }}">
                    @foreach($parent->children as $child)
                    <option value="{{ $child->id }}"
                      @if($product->category_id === $child->id)
                      selected
                      @endif  
                    >{{ $child->name }}</option>
                    @endforeach
                </optgroup>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row my-4 shadow-1-strong p-4">
        <h3 class="mb-5">Product Details</h3>
        <h5>Product Descriptions</h5>
        <p class="small muted">
            You can put any description and image as you want
        </p>
        <div id="editor" class="mb-5">{{ $product->description }}</div>
    </div>
    <div class="row mb-3 shadow-1-strong mb-4 p-4">
        <h3 class="mb-5">Product Setting</h3>
        <div id="productSetting">
            <input type="hidden" name="used_variant" value="" />
            <h5>Price</h5>
            <div class="input-group mb-5 w-50">
                <span class="input-group-text" id="basic-addon1">Rp</span>
                <input
                    name="variants[1][price]"
                    type="number"
                    class="form-control"
                    placeholder="Price"
                    value="{{ $products->single_variant->price }}"
                    required
                />
            </div>
            <h5>Status</h5>
            <div class="form-check form-switch mb-5 mx-3">
                <input
                    name="variants[1][active]"
                    class="form-check-input"
                    type="checkbox"
                    value="true"
                    id="flexSwitchCheckChecked"
                    @if($products->single_variant->active)
                    checked
                    @endif
                />
                <label class="form-check-label" for="flexSwitchCheckChecked"
                    >Product Inactive/Active</label
                >
            </div>
            <h5>Stock</h5>
            <div class="mb-5 w-50">
                <input
                    name="variants[1][stock]"
                    type="number"
                    id="form1"
                    class="form-control"
                    placeholder="Product stock"
                    value="{{ $products->single_variant->stock }}"
                    required
                />
            </div>
            <h5>SKU</h5>
            <div class="mb-5 w-50">
                <input
                    name="variants[1][sku]"
                    type="text"
                    id="form1"
                    class="form-control"
                    placeholder="Product SKU"
                    value="{{ $products->single_variant->sku }}"
                />
            </div>
        </div>
    </div>
    <div class="row mb-3 shadow-1-strong mb-4 p-4">
        <h3 class="mb-5">Shipment</h3>
        <h5>Weight</h5>
        <div class="input-group mb-5 w-50">
            <input
                name="weight"
                type="number"
                class="form-control"
                placeholder="Product weight"
                value="{{ $products->weight }}"
                required
            />
            <span class="input-group-text" id="basic-addon1">gr</span>
        </div>
        <h5>Dimensions</h5>
        <p class="small text-muted">Units in centimeter</p>
        <div class="input-group mb-5 w-50">
            <input
                name="dimensions[length]"
                type="number"
                class="form-control"
                value="{{ $product->length }}"
            />
            <span class="input-group-text">L</span>
            <input
                name="dimensions[width]"
                type="number"
                class="form-control"
                value="{{ $product->width }}"
            />
            <span class="input-group-text">W</span>
            <input
                name="dimensions[height]"
                type="number"
                class="form-control"
                value="{{ $product->height }}"
            />
            <span class="input-group-text">H</span>
        </div>
    </div>
    <div class="text-end">
        <a
            href="{{ route('admin.products') }}"
            class="btn btn-lg btn-light mx-3 mb-4"
            >Cancel</a
        >
        <button
            type="button"
            id="upload"
            class="btn btn-lg btn-success mb-4"
            disabled
        >
            Upload
        </button>
    </div>
</form>
@include('admin.modals.upload-product-fail')
@endsection
