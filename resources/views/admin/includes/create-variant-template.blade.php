<template id="variantInput">
    <tr>
        <td>
            @foreach($variants as $variant)
            <input
                type="text"
                name="new_variants[?][{{ $variant->name }}]"
                class="form-control"
                value=""
            />
            @endforeach
            <button class="btn btn-sm btn-danger text-white shadow-0 px-2">
                    <i class="far fa-trash-alt fa-lg"></i>
            </button>
        </td>
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
