@extends('layouts.admin-plain')

@section('title')
Edit Product
@endsection

@section('additional-script')
<script src="{{ mix('/js/pages/admin/createProduct.js') }}" defer></script>
@endsection

@section('content')
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
                value="{{ $master->name }}"
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
                      @if($master->category_id === $child->id)
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
            <div id="editor" class="mb-5">{{ $master->description }}</div>
          </div>
          <div class="row mb-3 shadow-1-strong mb-4 p-4">
            <h3 class="mb-5">Product Setting</h3>
            <input type="hidden" name="used_variant" value="{{ $master->used_variant }}" />
            <table class="table align-middle">
              <input type="hidden" name="used_variant" id="usedVariant" value="" />
              <thead>
                <tr>
                  <td scope="col">Variant</td>
                  <th scope="col">Price</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Status</th>
                  <th scope="col">SKU</th>
                  <th scope="col" width="100px">Image</th>
                </tr>
              </thead>
              <tbody>
                @foreach($master->products as $product)
                <tr>  
                <td>
                  {{ $product->variant_name }}
                  <button class="btn btn-sm btn-danger text-white shadow-0 px-2">
                    <i class="far fa-trash-alt fa-lg"></i>
                  </button>
                  <input
                    type="text"
                    name="variants[{{ $product->id }}][id]"
                    class="form-control"
                    value="{{$product->id}}"
                    readonly
                    hidden
                  />
                </td>
                <td>
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                    <input
                      name="variants[{{ $product->id }}][price]"
                      type="number"
                      class="form-control"
                      placeholder="Price"
                      value="{{ $product->price }}"
                      required
                    />
                  </div>
                </td>
                <td>
                  <input
                    type="number"
                    name="variants[{{ $product->id }}][stock]"
                    id="form1"
                    class="form-control"
                    required
                    placeholder="Product stock"
                    value="{{ $product->stock }}"
                  />
                </td>
                <td>
                  <div class="form-check form-switch">
                    <input
                      name="variants[{{ $product->id }}][active]"
                      class="form-check-input"
                      type="checkbox"
                      id="flexSwitchCheckChecked"
                      value="true"
                      @if($product->active)
                      checked
                      @endif
                    />
                  </div>
                </td>
                <td>
                  <input
                    type="text"
                    name="variants[{{ $product->id }}][sku]"
                    id="form1"
                    class="form-control"
                    placeholder="Product SKU"
                    value="{{ $product->sku }}"
                  />
                </td>
                <td>
                  <input
                    type="file"
                    name="variants[{{ $product->id }}][image]"
                    id="variantImage"
                    class="filepond"
                  />
                </td>
                </tr>
                @endforeach
                <tr id="addVariantRow">
                  <td colspan="6">
                    <button
                      id="addVariant"
                      type="button"
                      class="btn btn-lg btn-success shadow-0 mb-5 w-100"
                    >
                      ADD VARIANT
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
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
                value="{{ $master->weight }}"
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
                value="{{ $master->length }}"
              />
              <span class="input-group-text">L</span>
              <input
                name="dimensions[width]"
                type="number"
                class="form-control"
                value="{{ $master->width }}"
              />
              <span class="input-group-text">W</span>
              <input
                name="dimensions[height]"
                type="number"
                class="form-control"
                value="{{ $master->height }}"
              />
              <span class="input-group-text">H</span>
            </div>
          </div>
          <div class="text-end">
            <a href="{{ route('admin.products') }}" class="btn btn-lg btn-light mx-3 mb-4">Cancel</a>
            <button type="button" id="upload" class="btn btn-lg btn-success mb-4" disabled>
              Upload
            </button>
          </div>
        </form>
        @include('admin.includes.create-variant-template')
        @include('admin.modals.upload-product-fail')
@endsection