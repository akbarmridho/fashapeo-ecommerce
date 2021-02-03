<form action="" method="POST">
    @csrf
    <div class="row mb-4">
        <div class="col">
            <div class="form-outline">
                <input
                    name="warehouse_name"
                    type="text"
                    id="warehouse_name"
                    required
                    class="form-control
                    @error('warehouse_name')
                    is-invalid
                    @enderror
                    "
                />
                <label class="form-label" for="warehouse_name"
                    >Warehouse label</label
                >
                @error('warehouse_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="form-outline">
                <input name="description" type="text" id="warehouse_description" required class="form-control
                @error('description')
                is-invalid
                @enderror
                " />
                <label class="form-label" for="warehouse_description"
                    >Description</label
                >
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="form-outline">
                <input
                    name="address[label]"
                    type="text"
                    id="label"
                    required
                    class="form-control
                    @error('label')
                    is-invalid
                    @enderror
                    "
                />
                <label class="form-label" for="form6Example3"
                    >Address label</label
                >
                @error('label')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="form-outline">
                <input name="address[name]" type="text" id="name" required class="form-control
                @error('name')
                is-invalid
                @enderror
                " />
                <label class="form-label" for="form6Example3"
                    >Company name</label
                >
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="mb-4">
        <select required class="form-select" name="address[province]" id="province" disabled>
            <option value="" disabled selected>Select province</option>
        </select>
    </div>

    <div class="mb-4">
        <select required name="address[city]" class="form-select" id="city" disabled>
            <option value="" disabled selected>Select city</option>
        </select>
    </div>

    <input required type="number" name="address[vendor_id]" id="vendor" hidden />

    <div class="form-outline mb-4">
        <input required name="address[district]" type="text" id="district" class="form-control
        @error('district')
        is-invalid
        @enderror
        " />
        <label class="form-label" for="district">District</label>
        @error('district')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-outline mb-4">
        <input
            name="address[delivery_address]"
            type="text"
            id="deliveryAddress"
            class="form-control
            @error('delivery_address')
            is-invalid
            @enderror
            "
        />
        <label class="form-label" for="deliveryAddress">Delivery Address</label>
        @error('delivery_address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="form-outline mb-4">
                <input
                    name="address[phone]"
                    type="number"
                    id="phonenumber"
                    class="form-control"
                    minlength="9"
                    maxlength="15"
                />
                <label class="form-label" for="phonenumber">Phone</label>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="form-outline mb-4">
                <input
                    name="address[postal_code]"
                    type="number"
                    id="postalcode"
                    class="form-control
                    @error('postal_code')
                    is-invalid
                    @enderror
                    "
                    min="10000"
                    max="99999"
                />
                <label class="form-label" for="postalcode">Postal Code</label>
                @error('postal_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mb-4 float-end">
        Add Warehouse
    </button>
</form>
