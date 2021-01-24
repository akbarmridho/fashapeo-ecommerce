@extends('layouts.admin.plain')

@section('title')
Categories
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
              name="mainImage"
              id="mainImage"
              class="filepond"
            />
          </div>
          <div class="row my-4 shadow-1-strong p-4">
            <h3 class="mb-5">Product Info</h3>
            <h5>Product Title</h5>
            <div class="px-3 mb-5 w-75">
              <input
                name="title"
                type="text"
                id="form1"
                class="form-control"
                placeholder="Enter product title"
              />
            </div>
            <h5>Product Category</h5>
            <div class="px-3 mb-5">
              <x-admin.category-selection />
            </div>
          </div>
          <div class="row my-4 shadow-1-strong p-4">
            <h3 class="mb-5">Product Details</h3>
            <h5>Product Descriptions</h5>
            <p class="small muted">
              You can put any description and image as you want
            </p>
            <div id="editor" class="mb-5"></div>
          </div>
          <div class="row mb-3 shadow-1-strong mb-4 p-4">
            <h3 class="mb-5">Product Variant</h3>
            <div id="variantContent">
              <button
                id="addVariant"
                class="btn btn-lg btn-success shadow-0 mb-5 w-100"
              >
                ADD VARIANT
              </button>
            </div>
          </div>
          <div class="row mb-3 shadow-1-strong mb-4 p-4">
            <h3 class="mb-5">Product Setting</h3>
            <div id="productSetting">
              <input type="hidden" name="usedVariant" value="" />
              <h5>Price</h5>
              <div class="input-group mb-5 w-50">
                <span class="input-group-text" id="basic-addon1">Rp</span>
                <input
                  name="variants[1][price]"
                  type="number"
                  class="form-control"
                  placeholder="Price"
                />
              </div>
              <h5>Status</h5>
              <div class="form-check form-switch mb-5 mx-3">
                <input
                  name="variants[1][active]"
                  class="form-check-input"
                  type="checkbox"
                  id="flexSwitchCheckChecked"
                  checked
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
              />
              <span class="input-group-text" id="basic-addon1">gr</span>
            </div>
            <h5>Dimensions</h5>
            <p class="small text-muted">Units in centimeter</p>
            <div class="input-group mb-5 w-50">
              <input
                name="dimesions[length]"
                type="number"
                aria-label="First name"
                class="form-control"
              />
              <span class="input-group-text">L</span>
              <input
                name="dimesions[width]"
                type="number"
                aria-label="Last name"
                class="form-control"
              />
              <span class="input-group-text">W</span>
              <input
                name="dimesions[height]"
                type="number"
                aria-label="Last name"
                class="form-control"
              />
              <span class="input-group-text">H</span>
            </div>
          </div>
          <div class="text-end">
            <button class="btn btn-lg btn-light mx-3 mb-4">Cancel</button>
            <button id="upload" class="btn btn-lg btn-success mb-4">
              Upload
            </button>
          </div>
        </form>
@endsection