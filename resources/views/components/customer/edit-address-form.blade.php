<form action="{{ route('customer.address.update', ['address' => $address->id]) }}" method="POST">
    @csrf
    @method('put')
    <div class="row mb-4">
        <div class="col">
            <div class="form-outline">
                <input
                    name="label"
                    type="text"
                    id="label"
                    required
                    value="{{ $address->label }}"
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
                <input name="name" type="text" id="name" 
                value="{{ $address->name }}"
                required class="form-control
                @error('name')
                is-invalid
                @enderror
                " />
                <label class="form-label" for="form6Example3"
                    >Recipient name</label
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
        <select required class="form-select" name="province" id="province" data-selected="{{ $address->province }}" disabled>
            <option value="" disabled selected>Select province</option>
        </select>
    </div>

    <div class="mb-4">
        <select required name="city" class="form-select" id="city" data-selected="{{ $address->city }}" disabled>
            <option value="" disabled selected>Select city</option>
        </select>
    </div>

    <input required type="number" name="vendor_id" id="vendor" hidden />

    <div class="form-outline mb-4">
        <input required name="district" type="text" id="district" class="form-control
        @error('district')
        is-invalid
        @enderror
        "
        value="{{ $address->district }}"
        />
        <label class="form-label" for="district">District</label>
        @error('district')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-outline mb-4">
        <input
            name="delivery_address"
            type="text"
            id="deliveryAddress"
            value="{{ $address->delivery_address }}"
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
                    name="phone"
                    type="number"
                    id="phonenumber"
                    class="form-control"
                    minlength="9"
                    maxlength="15"
                    value="{{ $address->phone }}"
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
                    name="postal_code"
                    type="number"
                    id="postalcode"
                    class="form-control
                    @error('postal_code')
                    is-invalid
                    @enderror
                    "
                    min="10000"
                    max="99999"
                    value="{{ $address->postal_code }}"
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
        Update
    </button>
</form>
