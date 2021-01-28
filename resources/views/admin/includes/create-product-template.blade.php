<template id="multiVariant">
        <div class="mb-5">
          <select id="variantSelection" class="select-move" multiple>
            @foreach($variants as $variant)
            <option value="{{ $variant->id }}">{{ $variant->name }}</option>
            @endforeach
          </select>
          <div id="variantContainer"></div>

          <button
            id="removeVariant"
            class="btn btn-lg btn-danger shadow-0 mt-5 w-100"
            type="button"
          >
            REMOVE VARIANT
          </button>
        </div>
      </template>
      <template id="variantOptions">
        <div class="mt-4">
          <h5></h5>
          <div class="d-flex flex-wrap mb-3"></div>
          <div>
            <input
              type="text"
              placeholder="Add variant"
              class="form-control w-50"
            />
            <div class="invalid-feedback">
              Only 10 variant options that are allowed
            </div>
          </div>
        </div>
      </template>
      <template id="variantLabel">
        <div class="rounded-pill btn-info px-3 py-1 text-white me-3 my-2"></div>
        <i class="fas fa-times ps-2"></i>
      </template>
      <template id="variantsTable">
        <table class="table align-middle">
          <input type="hidden" name="used_variant" id="usedVariant" value="" />
          <thead>
            <tr>
              <th scope="col">Price</th>
              <th scope="col">Stock</th>
              <th scope="col">Status</th>
              <th scope="col">SKU</th>
              <th scope="col" width="100px">Image</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </template>
      <template id="variantName">
        <td>
          <input
            type="text"
            name="variants"
            class="form-control"
            value=""
            readonly
          />
        </td>
      </template>
      <template id="variantInput">
        <tr>
          <td>
            <div class="input-group">
              <span class="input-group-text" id="basic-addon1">Rp</span>
              <input
                name="variants[?][price]"
                type="number"
                class="form-control"
                placeholder="Price"
                required
              />
            </div>
          </td>
          <td>
            <input
              type="number"
              name="variants[?][stock]"
              id="form1"
              class="form-control"
              required
              placeholder="Product stock"
            />
          </td>
          <td>
            <div class="form-check form-switch">
              <input
                name="variants[?][active]"
                class="form-check-input"
                type="checkbox"
                id="flexSwitchCheckChecked"
                value="true"
              />
            </div>
          </td>
          <td>
            <input
              type="text"
              name="variants[?][sku]"
              id="form1"
              class="form-control"
              placeholder="Product SKU"
            />
          </td>
          <td>
            <input
              type="file"
              name="variants[?][image]"
              id="variantImage"
              class="filepond"
            />
          </td>
        </tr>
      </template>