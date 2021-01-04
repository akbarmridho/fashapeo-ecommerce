<form>
    <div class="row mb-4">
        <div class="col">
            <div class="form-outline">
    <input type="text" id="label" class="form-control" />
    <label class="form-label" for="form6Example3">Address label</label>
  </div>
        </div>
        <div class="col">
            <div class="form-outline">
    <input type="text" id="name" class="form-control" />
    <label class="form-label" for="form6Example3">Recipient name</label>
  </div>
        </div>
    </div>

  <div class="mb-4">
    {{-- <label class="form-label" for="province">Province</label> --}}
    <select class="form-select" id="province" disabled>
          <option value="" disabled selected>Select province</option>
    </select>
    
  </div>

    <div class="mb-4">
        {{-- <label class="form-label" for="city">City</label> --}}
        <select class="form-select" id="city" disabled>
          <option value="" disabled selected>Select city</option>
        </select>
    
  </div>
  
  <div class="form-outline mb-4">
    <input type="text" id="deliveryAddress" class="form-control" />
    <label class="form-label" for="deliveryAddress">Delivery Address</label>
  </div>

<div class="row mb-4">
    <div class="col">
 <div class="form-outline mb-4">
    <input type="number" id="phonenumber" class="form-control" />
    <label class="form-label" for="phonenumber">Phone</label>
  </div>
    </div>
    <div class="col">
 <div class="form-outline mb-4">
    <input type="number" id="postalcode" class="form-control" min="10000" max="99999"/>
    <label class="form-label" for="postalcode">Postal Code</label>
  </div>
    </div>
</div>
  <button type="submit" class="btn btn-primary mb-4 float-end">Add Address</button>
</form>